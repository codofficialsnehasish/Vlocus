<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Shop;
use App\Models\Driver;
use App\Models\DeliverySchedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        // $drivers = User::role('Driver')->latest()->get();
        $drivers = User::role('Driver')
                    ->with(['driver', 'currentActiveDelivery.vehicle'])
                    ->latest()
                    ->get();

        $vehicles = Vehicle::latest()->get();
        $shops = Shop::latest()->get(); 
        return view('admin.tracking.index',compact('drivers','vehicles','shops'));
    }
    
    public function order_tracking(Request $request){
        // $delivery = DeliverySchedule::with('deliveryScheduleShops')->findOrFail($request->delivery_id);
        $delivery = DeliverySchedule::with([
                        'deliveryScheduleShops' => function ($query) use ($request) {
                            $query->where('id', $request->shop_id);
                        }
                    ])->findOrFail($request->delivery_id);

        $driver = $delivery->driver;
        $driver_details = $delivery->driver->driver;
        $delivery_schedule_shops = $delivery->deliveryScheduleShops;
        $delivery_sender_branch = $delivery->deliveryScheduleShops->first();
        $delivery_shop = $delivery_sender_branch->shop;
        $products = $delivery_sender_branch->products;
        $delivery_sender_branch = $delivery_sender_branch->branch->branch;
        return view('order_tracking', compact('delivery', 'products', 'delivery_shop', 'driver', 'driver_details', 'delivery_schedule_shops','delivery_sender_branch'));
    }

    public function get_driver_location($id){
        $driver = Driver::where('user_id',$id)->first();
        return response()->json([
            'latitude' => $driver->latitude,
            'longitude' => $driver->longitude
        ]);
    }
}
