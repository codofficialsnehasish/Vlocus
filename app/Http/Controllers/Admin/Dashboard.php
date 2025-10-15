<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\User;

use App\Models\Vehicle;
use App\Models\DeliverySchedule;
use App\Models\DeliveryScheduleShop;
use App\Models\Shop;
use App\Models\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index(){
        if (auth()->user()->hasRole('Customer')) {
            return redirect()->route('front.user.profile');
        }
        
        if(Auth::user()->hasRole('Driver')){
            $data['deliveries'] = DeliverySchedule::where('driver_id', Auth::id())
                                        ->whereDate('delivery_date', date('Y-m-d'))
                                        // ->with(['shops', 'vehicle'])
                                        ->with(['shops', 'vehicle', 'deliveryScheduleShops' => function ($query) {
                                            $query->select('id', 'delivery_schedule_id', 'shop_id', 'is_delivered'); // Include only necessary fields
                                        }])
                                        ->get();

            $data['totalAssignedShops'] = DeliverySchedule::where('driver_id', Auth::id())
                                        ->whereDate('delivery_date', date('Y-m-d'))
                                        ->withCount('shops')
                                        ->get()
                                        ->sum('shops_count');
    
            // Get total delivered deliveries
            $data['totalDelivered'] = DeliveryScheduleShop::whereHas('deliverySchedule', function ($query) {
                                                    $query->where('driver_id', Auth::id())
                                                            ->whereDate('delivery_date', date('Y-m-d'));
                                                })->where('is_delivered', 1)->count();
        
            // Get total pending deliveries
            $data['totalPending'] = $data['totalAssignedShops'] - $data['totalDelivered'];
            
        }else{
            $data['system_user'] = User::whereDoesntHave('roles', function($query) {
                $query->whereIn('name', ['Super Admin','Driver']);
            })->count();
    
            $data['driver'] = User::role('Driver')->count();
            $data['company'] = User::role('Company')->count();
            $data['branch'] = User::role('Branch')->count();
            $data['employee'] = User::role('Employee')->count();
        
            $data['vehicle'] = Vehicle::all()->count();

            $data['shop'] = Shop::all()->count();
            $data['delivery_schedule'] = DeliverySchedule::all()->count();
            $data['delivery_schedule_task'] = DeliveryScheduleShop::all()->count();

            $data['total_completed_task'] = DeliveryScheduleShop::where('is_delivered',1)->count();
            $data['total_cancelled_task'] = DeliveryScheduleShop::where('is_cancelled',1)->count();

            $data['vehicleGrowth'] = Vehicle::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            $data['deliveryGrowth'] = DeliverySchedule::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            // $data['branchStats'] = Branch::withCount('shops')->get();
        }

        return view('dashboard')->with($data);
    }


    public function update_delivery(Request $request){
        $delivery = DeliveryScheduleShop::find($request->delivery_id);
        $message = '';
        if ($request->status === 'delivered') {
            if ($request->otp == $delivery->otp) {
                $delivery->is_delivered = 1;
                $delivery->delivered_at = now();
                $message = 'OTP Verified & Delivered Successfully';
            } else {
                return response()->json(['error' => 'Invalid OTP'], 400);
            }
        } else {
            $delivery->is_delivered = 2;
            $delivery->cancel_reason = $request->reason;
            $message = 'Delivery Cancelled Successfully';
        }
        $delivery->update();
        return response()->json(['success' => true,'message'=>$message]);
    }

    public function resend_delivery_otp(Request $request){
        $delivery = DeliveryScheduleShop::find($request->delivery_id);
        $delivery->otp = 1234;
        $delivery->update();
        return response()->json(['success' => true,'message'=>'OTP Send Successfully']);
    }
}