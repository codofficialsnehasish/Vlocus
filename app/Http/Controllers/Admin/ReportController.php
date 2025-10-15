<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Branch;
use App\Models\DeliveryScheduleShop;
use App\Models\DeliveryScheduleShopProduct;
use App\Models\SOSAlert;
use App\Models\LoginLog;
use Carbon\Carbon;

class ReportController extends Controller
{
    // 1. Trip Summary Report
    public function tripSummary()
    {
        $reports = DeliveryScheduleShop::with('branch')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reports.trip_summary', compact('reports'));
    }

    // 2. Route History Report
    public function routeHistory()
    {
        // Dummy data for liquor shops
        $shopNames = ['The Wine Cellar', 'Spirits Hub', 'Cheers Liquor', 'Royal Drinks', 'Bottle House', 'Liquor Lane'];
        $products = ['Whiskey', 'Vodka', 'Rum', 'Beer', 'Wine', 'Gin', 'Tequila'];

        $reports = collect();

        for ($i = 1; $i <= 20; $i++) {
            $shopName = $shopNames[array_rand($shopNames)];
            $branchName = ['North Branch', 'South Branch', 'East Branch', 'West Branch'][array_rand(['North Branch','South Branch','East Branch','West Branch'])];
            $product = $products[array_rand($products)];
            $reports->push((object)[
                'shop' => (object)['name' => $shopName, 'branch' => (object)['name' => $branchName]],
                'product_name' => $product,
                'delivered_qty' => rand(1, 50),
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        // Paginate dummy data
        $reports = new \Illuminate\Pagination\LengthAwarePaginator(
            $reports,
            $reports->count(),
            10,
            1,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.reports.route_history', compact('reports'));
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
