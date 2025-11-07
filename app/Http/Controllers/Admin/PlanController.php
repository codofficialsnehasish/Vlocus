<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Feature;
use App\Models\PlanFeature;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::with('features')->orderBy('id', 'asc')->get();
        $features = Feature::orderBy('category')->orderBy('order')->get();
        return view('admin.plan.index', compact('plans', 'features'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'coins' => 'required|integer|min:0',
            'task_coin_cost' => 'required|integer|min:1',
        ]);

        Plan::create($request->only('name', 'description', 'price', 'coins', 'task_coin_cost', 'is_active'));

        return back()->with('success', 'Plan created successfully!');
    }

    public function storeFeature(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        Feature::create($request->only('name', 'category', 'order'));
        return back()->with('success', 'Feature created successfully!');
    }

    public function updateMapping(Request $request)
    {
        $data = $request->input('mapping', []);

        DB::transaction(function () use ($data) {
            foreach ($data as $planId => $features) {
                foreach ($features as $featureId => $map) {
                    PlanFeature::updateOrCreate(
                        ['plan_id' => $planId, 'feature_id' => $featureId],
                        [
                            'availability' => $map['availability'] ?? 'no',
                            'details' => $map['details'] ?? null,
                        ]
                    );
                }
            }
        });

        return back()->with('success', 'Plan feature mapping updated!');
    }

    // Edit Plan
    public function editPlan($id)
    {
        $plan = Plan::findOrFail($id);
        return response()->json($plan);
    }

    // Update Plan
    public function updatePlan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'coins' => 'required|integer|min:0',
            'task_coin_cost' => 'required|integer|min:1',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update($request->only('name', 'description', 'price', 'coins', 'task_coin_cost', 'is_active'));

        return back()->with('success', 'Plan updated successfully!');
    }

    // Delete Plan
    public function destroyPlan($id)
    {
        Plan::findOrFail($id)->delete();
        return back()->with('success', 'Plan deleted successfully!');
    }


    // Edit Feature
    public function editFeature($id)
    {
        $feature = Feature::findOrFail($id);
        return response()->json($feature);
    }

    // Update Feature
    public function updateFeature(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $feature = Feature::findOrFail($id);
        $feature->update($request->only('name', 'category', 'order'));

        return back()->with('success', 'Feature updated successfully!');
    }

    // Delete Feature
    public function destroyFeature($id)
    {
        Feature::findOrFail($id)->delete();
        return back()->with('success', 'Feature deleted successfully!');
    }

}
