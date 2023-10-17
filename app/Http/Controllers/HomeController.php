<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscription = new Subscription;
        $invoices = auth()->user()->invoices()->get();
        return view('home', ['subscription' => $subscription->getUserSubscription(auth()->user()), 'invoices' => $invoices]);
    }
}
