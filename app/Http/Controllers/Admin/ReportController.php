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
    public function runIdle()
    {
        $reports = [
            ['vehicle' => 'WB01AB1234', 'run_time' => '3h 45m', 'idle_time' => '1h 10m', 'stops' => 4],
            ['vehicle' => 'WB02XY5678', 'run_time' => '5h 10m', 'idle_time' => '0h 25m', 'stops' => 2],
        ];
        return view('admin.reports.run_idle', compact('reports'));
    }

    // 4. Distance Report
    public function distance()
    {
        $reports = [
            ['vehicle' => 'WB01AB1234', 'day' => '2025-10-13', 'distance' => '185 km'],
            ['vehicle' => 'WB02XY5678', 'day' => '2025-10-13', 'distance' => '210 km'],
        ];
        return view('admin.reports.distance', compact('reports'));
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
    public function overstay()
    {
        $reports = [
            ['vehicle' => 'WB01AB1234', 'location' => 'Kolkata Depot', 'allowed_time' => '30 min', 'actual_time' => '1h 15m'],
            ['vehicle' => 'WB02XY5678', 'location' => 'Howrah Site', 'allowed_time' => '20 min', 'actual_time' => '45 min'],
        ];
        return view('admin.reports.overstay', compact('reports'));
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
