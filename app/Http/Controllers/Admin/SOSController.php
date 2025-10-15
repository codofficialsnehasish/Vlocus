<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SOSAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SOSController extends Controller
{
    public function index()
    {
        
        $sos_alerts = SOSAlert::latest()->get();
        return view('admin.sos_alert.index',compact('sos_alerts'));
    }
    
        public function delete($id)
    {
        
        $sos_alert = SOSAlert::findOrFail($id);
        if (!$sos_alert) {
            return redirect()->back()->withErrors(['error' => 'SOS Alert not found.'])->withInput();
        }
        $sos_alert->delete();
        return response()->json(['success' => 'SOS Alert Deleted Successfully']);
    }
}
