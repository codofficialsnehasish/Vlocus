<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Branch;
use App\Models\DeliverySchedule;
use App\Models\DeliveryScheduleShop;
use App\Models\DeliveryScheduleShopProduct;
use App\Models\SOSAlert;
use App\Models\LoginLog;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    // 1. Trip Summary Report
    public function tripSummary()
    {
        $reports = DeliveryScheduleShop::with(['deliverySchedule','shop','products'])
            ->get();

        foreach ($reports as $report) {
            if ($report->accepted_lat && $report->accepted_long && $report->deliver_lat && $report->deliver_long) {
                $origin = $report->accepted_lat . ',' . $report->accepted_long;
                $destination = $report->deliver_lat . ',' . $report->deliver_long;
                $apiKey = env('GOOGLE_MAPS_API_KEY');

                $response = Http::get("https://maps.gomaps.pro/maps/api/distancematrix/json", [
                    'origins' => $origin,
                    'destinations' => $destination,
                    'key' => $apiKey
                ]);

                $data = $response->json();

                // Distance
                $report->calculated_distance = $data['rows'][0]['elements'][0]['distance']['text'] ?? 'N/A';

                // Addresses
                $report->origin_address = $data['origin_addresses'][0] ?? null;
                $report->destination_address = $data['destination_addresses'][0] ?? null;

            } else {
                $report->calculated_distance = 'N/A';
                $report->destination_address = null;
                $apiKey = env('GOOGLE_MAPS_API_KEY');
                $latitude = $report->accepted_lat;
                $longitude = $report->accepted_long;

                $response = Http::withHeaders([
                    'Accept' => 'application/json'
                ])->get('https://maps.gomaps.pro/maps/api/geocode/json', [
                    'latlng' => "$latitude,$longitude",
                    'key' => $apiKey,
                ]);

                $data = $response->json();
                if (!empty($data['results'][0]['formatted_address'])) {
                    $report->origin_address = $data['results'][0]['formatted_address'];
                } else {
                    $report->origin_address = null;
                }
            }
        }

        return view('admin.reports.trip_summary', compact('reports'));
    }

    // 2. Route History Report
    public function routeHistory(Request $request)
    {
        $query = DeliverySchedule::with([
            'vehicle',
            'driver',
            'deliveryScheduleShops' => function ($q) {
                $q->with('products');
            }
        ]);

        // Optional filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('delivery_date', [$request->start_date, $request->end_date]);
        }

        $schedules = $query->orderBy('delivery_date', 'desc')->get();

        $apiKey = env('GOOGLE_MAPS_API_KEY');

        foreach ($schedules as $schedule) {
            $points = [];

            // collect all coordinates (accepted + delivered)
            foreach ($schedule->deliveryScheduleShops as $shop) {
                if ($shop->accepted_lat && $shop->accepted_long) {
                    $points[] = "{$shop->accepted_lat},{$shop->accepted_long}";
                }
                if ($shop->deliver_lat && $shop->deliver_long) {
                    $points[] = "{$shop->deliver_lat},{$shop->deliver_long}";
                }
            }

            // build route using snapped path API or Distance Matrix
            if (count($points) >= 2) {
                $path = implode('|', $points);

                $response = Http::get("https://maps.gomaps.pro/maps/api/directions/json", [
                    'origin' => $points[0],
                    'destination' => end($points),
                    'waypoints' => implode('|', array_slice($points, 1, -1)),
                    'key' => $apiKey
                ]);

                $data = $response->json();

                $schedule->total_distance = $data['routes'][0]['legs'][0]['distance']['text'] ?? 'N/A';
                $schedule->route_polyline = $data['routes'][0]['overview_polyline']['points'] ?? null;
            } else {
                $schedule->total_distance = 'N/A';
                $schedule->route_polyline = null;
            }
        }

        return view('admin.reports.route_history', compact('schedules'));
    }

    // 3. Run & Idle Report
    /*public function runIdle(Request $request)
    {
        // Optional filters (date range)
        $startDate = $request->start_date ?? now()->startOfDay();
        $endDate = $request->end_date ?? now()->endOfDay();

        // Fetch all drivers (or filter by driver_id if passed)
        $drivers = Driver::with(['locations' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('timestamp', [$startDate, $endDate])
                ->orderBy('timestamp');
        }])->get();
        
        $drivers = Driver::with('locations')->orderBy('created_at')->get();

        $reports = [];

        foreach ($drivers as $driver) {
            $locations = $driver->locations;
        
            if ($locations->isEmpty()) {
                $reports[] = [
                    'driver' => $driver->user?->name ?? 'Unknown',
                    'date' => null,
                    'run_time' => '0h 0m',
                    'idle_time' => '0h 0m',
                    'stops' => 0,
                ];
                continue;
            }
        
            // ✅ Group locations by date
            $groupedByDate = $locations->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->toDateString(); // 'Y-m-d'
            });
        
            foreach ($groupedByDate as $date => $dailyLocations) {
                $runTime = 0;
                $idleTime = 0;
                $stops = 0;
        
                $previous = null;
                $idleSegmentStart = null;
        
                foreach ($dailyLocations as $location) {
                    if ($previous) {
                        $timeDiff = Carbon::parse($previous->created_at)->diffInMinutes($location->created_at);
        
                        // Calculate distance moved (in meters)
                        $distance = $this->calculateDistance(
                            $previous->latitude,
                            $previous->longitude,
                            $location->latitude,
                            $location->longitude
                        );
        
                        if ($distance < 30) {
                            $idleTime += $timeDiff;
        
                            if (!$idleSegmentStart) {
                                $idleSegmentStart = Carbon::parse($previous->created_at);
                            }
        
                            if ($idleSegmentStart->diffInMinutes($location->created_at) >= 5) {
                                $stops++;
                                $idleSegmentStart = null;
                            }
                        } else {
                            $runTime += $timeDiff;
                            $idleSegmentStart = null;
                        }
                    }
        
                    $previous = $location;
                }
        
                $reports[] = [
                    'driver' => $driver->user?->name ?? 'Unknown',
                    'date' => $date,
                    'run_time' => floor($runTime / 60) . 'h ' . ($runTime % 60) . 'm',
                    'idle_time' => floor($idleTime / 60) . 'h ' . ($idleTime % 60) . 'm',
                    'stops' => $stops,
                ];
            }
        }

        return view('admin.reports.run_idle', compact('reports', 'startDate', 'endDate'));
    }*/
    
    public function runIdle(Request $request)
    {
        $startDate = $request->start_date ?? null;
        $endDate   = $request->end_date ?? null;
        
        $schedulesQuery = DeliverySchedule::with(['driver', 'vehicle', 'shops'])
                        ->orderBy('delivery_date');
        
        if ($startDate && $endDate) {
            $schedulesQuery->whereDate('delivery_date', '>=', $startDate)
                            ->whereDate('delivery_date', '<=', $endDate);
        }
        
        $schedules = $schedulesQuery->get();
        $reports = [];
    
        foreach ($schedules as $schedule) {
            $locations = $schedule->driver?->driver?->locations
                        ?->filter(function ($location) use ($schedule) {
                            return \Carbon\Carbon::parse($location->created_at)->isSameDay($schedule->delivery_date);
                        })
                        ->sortBy('created_at') ?? collect();
                        
            // 🕒 Get first accepted and last delivered shop times
            $firstAcceptTime = $schedule->deliveryScheduleShops
                ->whereNotNull('accepted_at')
                ->sortBy('accepted_at')
                ->first()?->accepted_at;
            // dd($schedule->shops);
            
            $lastDeliveredTime = $schedule->deliveryScheduleShops
                ->whereNotNull('delivered_at')
                ->sortByDesc('delivered_at')
                ->first()?->delivered_at;
    
            if ($locations->isEmpty()) {
                $reports[] = [
                    'date' => $schedule->delivery_date,
                    'driver' => $schedule->driver?->name ?? 'Unknown',
                    'vehicle' => $schedule->vehicle?->vehicle_number ?? 'Unknown',
                    'start_time' => $firstAcceptTime ? Carbon::parse($firstAcceptTime)->format('H:i') : null,
                    'end_time' => $lastDeliveredTime ? Carbon::parse($lastDeliveredTime)->format('H:i') : null,
                    'run_time' => '0h 0m',
                    'idle_time' => '0h 0m',
                    'stops' => 0,
                ];
                continue;
            }
    
            $runTime = 0;
            $idleTime = 0;
            $stops = 0;
            $previous = null;
            $idleSegmentStart = null;
    
            foreach ($locations as $location) {
                // dd($location);
                if ($previous) {
                    $timeDiff = Carbon::parse($previous->created_at)->diffInMinutes($location->created_at);
                    $distance = $this->calculateDistance(
                        $previous->latitude,
                        $previous->longitude,
                        $location->latitude,
                        $location->longitude
                    );
    
                    if ($distance < 30) {
                        $idleTime += $timeDiff;
                        if (!$idleSegmentStart) {
                            $idleSegmentStart = Carbon::parse($previous->created_at);
                        }
                        if ($idleSegmentStart->diffInMinutes($location->created_at) >= 5) {
                            $stops++;
                            $idleSegmentStart = null;
                        }
                    } else {
                        $runTime += $timeDiff;
                        $idleSegmentStart = null;
                    }
                }
                $previous = $location;
            }
    
            $reports[] = [
                'date' => $schedule->delivery_date,
                'driver' => $schedule->driver?->name ?? 'Unknown',
                'vehicle' => $schedule->vehicle?->vehicle_number ?? 'Unknown',
                'start_time' => $firstAcceptTime ? Carbon::parse($firstAcceptTime)->format('H:i') : ($locations->first()?->created_at ? Carbon::parse($locations->first()->created_at)->format('H:i') : null),
                'end_time' => $lastDeliveredTime ? Carbon::parse($lastDeliveredTime)->format('H:i') : ($locations->last()?->created_at ? Carbon::parse($locations->last()->created_at)->format('H:i') : null),
                'run_time' => floor($runTime / 60) . 'h ' . ($runTime % 60) . 'm',
                'idle_time' => floor($idleTime / 60) . 'h ' . ($idleTime % 60) . 'm',
                'stops' => $stops,
            ];
        }
        
        // dd($reports);
    
        return view('admin.reports.run_idle', compact('reports', 'startDate', 'endDate'));
    }


    /**
     * Calculate distance between two lat/long points (Haversine formula)
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $earthRadius * $angle; // meters
    }

    // 4. Distance Report
    public function distance(Request $request)
    {
        $startDate = $request->start_date ?? null;
        $endDate   = $request->end_date ?? null;

        $schedulesQuery = DeliverySchedule::with(['driver.driver.locations', 'vehicle'])
                            ->orderBy('delivery_date');

        if ($startDate && $endDate) {
            $schedulesQuery->whereDate('delivery_date', '>=', $startDate)
                        ->whereDate('delivery_date', '<=', $endDate);
        }

        $schedules = $schedulesQuery->get();
        $reports = [];

        foreach ($schedules as $schedule) {
            $locations = $schedule->driver?->driver?->locations
                ?->filter(function ($location) use ($schedule) {
                    return \Carbon\Carbon::parse($location->created_at)
                        ->isSameDay($schedule->delivery_date);
                })
                ->sortBy('created_at') ?? collect();

            if ($locations->count() < 2) {
                $reports[] = [
                    'date' => $schedule->delivery_date,
                    'driver' => $schedule->driver?->name ?? 'Unknown',
                    'vehicle' => $schedule->vehicle?->vehicle_number ?? 'Unknown',
                    'start_time' => $locations->first()?->created_at ? \Carbon\Carbon::parse($locations->first()->created_at)->format('H:i') : null,
                    'end_time' => $locations->last()?->created_at ? \Carbon\Carbon::parse($locations->last()->created_at)->format('H:i') : null,
                    'distance' => '0 km',
                ];
                continue;
            }

            $totalDistance = 0;
            $previous = null;

            foreach ($locations as $location) {
                if ($previous) {
                    $totalDistance += $this->calculateDistance(
                        $previous->latitude,
                        $previous->longitude,
                        $location->latitude,
                        $location->longitude
                    );
                }
                $previous = $location;
            }

            $reports[] = [
                'date' => $schedule->delivery_date,
                'driver' => $schedule->driver?->name ?? 'Unknown',
                'vehicle' => $schedule->vehicle?->vehicle_number ?? 'Unknown',
                'start_time' => \Carbon\Carbon::parse($locations->first()->created_at)->format('H:i'),
                'end_time' => \Carbon\Carbon::parse($locations->last()->created_at)->format('H:i'),
                'distance' => number_format($totalDistance / 1000, 2) . ' km', // meters → km
            ];
        }

        return view('admin.reports.distance', compact('reports', 'startDate', 'endDate'));
    }

    // 5. Geo-fence Report
    public function geofence()
    {
        $reports = [
            ['vehicle' => 'WB01AB1234', 'zone' => 'Kolkata Depot', 'entry_time' => '08:15 AM', 'exit_time' => '09:05 AM'],
            ['vehicle' => 'WB02XY5678', 'zone' => 'Howrah Site', 'entry_time' => '10:30 AM', 'exit_time' => '11:10 AM'],
        ];
        return view('admin.reports.geofence', compact('reports'));
    }

    // 6. Overstay Report
    public function overstay(Request $request)
    {
        $startDate = $request->start_date ?? null;
        $endDate   = $request->end_date ?? null;

        $schedulesQuery = DeliverySchedule::with(['driver.driver.locations', 'vehicle'])
                            ->orderBy('delivery_date');

        if ($startDate && $endDate) {
            $schedulesQuery->whereDate('delivery_date', '>=', $startDate)
                        ->whereDate('delivery_date', '<=', $endDate);
        }

        $schedules = $schedulesQuery->get();
        $reports = [];

        foreach ($schedules as $schedule) {
            $locations = $schedule->driver?->driver?->locations
                ?->filter(function ($location) use ($schedule) {
                    return \Carbon\Carbon::parse($location->created_at)
                        ->isSameDay($schedule->delivery_date);
                })
                ->sortBy('created_at') ?? collect();

            if ($locations->count() < 2) continue;

            $previous = null;
            $idleStart = null;

            foreach ($locations as $location) {
                if ($previous) {
                    $distance = $this->calculateDistance(
                        $previous->latitude,
                        $previous->longitude,
                        $location->latitude,
                        $location->longitude
                    );

                    // If vehicle is staying at same spot (less than 30 meters)
                    if ($distance < 30) {
                        if (!$idleStart) {
                            $idleStart = $previous->created_at;
                        }
                    } else {
                        // Vehicle moved — so record overstay if duration was significant
                        if ($idleStart) {
                            $idleEnd = $previous->created_at;
                            $durationMinutes = \Carbon\Carbon::parse($idleStart)->diffInMinutes($idleEnd);

                            // Log only if stay lasted more than 10 minutes (to ignore GPS noise)
                            if ($durationMinutes > 10) {
                                $reports[] = [
                                    'vehicle' => $schedule->vehicle?->vehicle_number ?? 'Unknown',
                                    'driver' => $schedule->driver?->name ?? 'Unknown',
                                    'date' => $schedule->delivery_date,
                                    'location' => '(' . number_format($previous->latitude, 5) . ', ' . number_format($previous->longitude, 5) . ')',
                                    'start_time' => \Carbon\Carbon::parse($idleStart)->format('H:i:s'),
                                    'end_time' => \Carbon\Carbon::parse($idleEnd)->format('H:i:s'),
                                    'duration' => floor($durationMinutes / 60) . 'h ' . ($durationMinutes % 60) . 'm',
                                ];
                            }

                            $idleStart = null;
                        }
                    }
                }

                $previous = $location;
            }

            // If still idle at end of day
            if ($idleStart && $previous) {
                $idleEnd = $previous->created_at;
                $durationMinutes = \Carbon\Carbon::parse($idleStart)->diffInMinutes($idleEnd);
                if ($durationMinutes > 10) {
                    $reports[] = [
                        'vehicle' => $schedule->vehicle?->vehicle_number ?? 'Unknown',
                        'driver' => $schedule->driver?->name ?? 'Unknown',
                        'date' => $schedule->delivery_date,
                        'location' => '(' . number_format($previous->latitude, 5) . ', ' . number_format($previous->longitude, 5) . ')',
                        'start_time' => \Carbon\Carbon::parse($idleStart)->format('H:i:s'),
                        'end_time' => \Carbon\Carbon::parse($idleEnd)->format('H:i:s'),
                        'duration' => floor($durationMinutes / 60) . 'h ' . ($durationMinutes % 60) . 'm',
                    ];
                }
            }
        }

        return view('admin.reports.overstay', compact('reports', 'startDate', 'endDate'));
    }

    // Driver Behaviour & Safety Reports

    // 🚗 Driver Attendance Report
    public function attendance()
    {
        // Group by driver and month
        $reports = LoginLog::selectRaw('user_id, MONTHNAME(created_at) as month, COUNT(DISTINCT DATE(created_at)) as present_days')
            ->with('driver')
            ->groupBy('user_id', 'month')
            ->get()
            ->map(function ($row) {
                return [
                    'driver' => $row->driver->name ?? 'Unknown',
                    'month' => $row->month,
                    'present_days' => $row->present_days,
                    'absent_days' => 30 - $row->present_days, // assuming 30 days month
                ];
            });

        return view('admin.reports.attendance', compact('reports'));
    }

    // 🕒 Login & Logout Report
    public function loginLogout()
    {
        $reports = LoginLog::with('driver')
            ->select('user_id', 'device', 'ip_address', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('user_id')
            ->map(function ($logs) {
                $driver = $logs->first()->driver->name ?? 'Unknown';
                $groupedByDate = $logs->groupBy(function ($log) {
                    return Carbon::parse($log->created_at)->format('Y-m-d');
                });

                return $groupedByDate->map(function ($dayLogs, $date) use ($driver) {
                    $login = $dayLogs->where('status', 'login')->first();
                    $logout = $dayLogs->where('status', 'logout')->last();

                    return [
                        'driver' => $driver,
                        'date' => $date,
                        'login' => $login ? Carbon::parse($login->created_at)->format('h:i A') : 'N/A',
                        'logout' => $logout ? Carbon::parse($logout->created_at)->format('h:i A') : 'N/A',
                    ];
                })->values();
            })
            ->flatten(1);

        return view('admin.reports.login_logout', compact('reports'));
    }

    // ⏰ Daily Login Time Report
    public function loginTime()
    {
        $reports = LoginLog::with('driver')
            ->where('status', 'login')
            ->select('user_id', 'created_at')
            ->latest()
            ->get()
            ->map(function ($log) {
                return [
                    'driver' => $log->driver->name ?? 'Unknown',
                    'date' => $log->created_at->format('Y-m-d'),
                    'login_time' => $log->created_at->format('h:i A'),
                ];
            });

        return view('admin.reports.login_time', compact('reports'));
    }

    public function emergencySos()
    {
        $reports = SOSAlert::with('driver')->latest()->paginate(20);
        return view('admin.reports.sos_report', compact('reports'));
    }
}
