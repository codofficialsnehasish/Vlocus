<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanApiController extends Controller
{
    /**
     * Get all plans with their mapped features
     * for showing in website pricing comparison.
     */
    public function index()
    {
        $plans = Plan::with([
            'features.feature' => function ($q) {
                $q->select('id', 'name', 'category', 'order');
            }
        ])
        ->where('is_active', true)
        ->orderBy('price', 'asc')
        ->get();

        // Format data cleanly
        $data = $plans->map(function ($plan) {
            return [
                'id' => $plan->id,
                'name' => $plan->name,
                'description' => $plan->description,
                'price' => $plan->price,
                'coins' => $plan->coins,
                'task_coin_cost' => $plan->task_coin_cost,
                'features' => $plan->features->map(function ($pf) {
                    return [
                        'feature_id' => $pf->feature_id,
                        'name' => $pf->feature->name ?? '',
                        'category' => $pf->feature->category ?? null,
                        'availability' => $pf->availability,
                        'details' => $pf->details,
                    ];
                })->sortBy('feature.category')->values(),
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
