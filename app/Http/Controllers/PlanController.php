<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{

    public function index()
    {
        $plans = Plan::get();

        return view('plans', compact('plans'));
    }

    public function show(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();

        return view('subscription', compact('plan', 'intent'));
    }

    public function subscription(Request $request)
    {
        $plan = Plan::find($request->plan);

        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
            ->create($request->token);

        return view('subscription-success');
    }

    public function subscriptionCansel(Request $request)
    {
        if ($request->subscriptionName){
            auth()->user()->subscription($request->subscriptionName)->cancelNow();
            return 'subscription canceled';
        }
        else{
            return 'wrong request';
        }
    }
}
