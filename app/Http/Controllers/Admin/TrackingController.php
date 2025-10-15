<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        $drivers = User::role('Driver')->latest()->get();

        $vehicles = Vehicle::latest()->get();
        $shops = Shop::latest()->get(); 
        return view('admin.tracking.index',compact('drivers','vehicles','shops'));
    }
}
