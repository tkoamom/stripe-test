<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    Route::get('plans', [PlanController::class, 'index'])->name('plans');
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
    Route::post('subscription', [PlanController::class, 'subscription'])->name('subscription.create');
    Route::post('subscription/cansel', [PlanController::class, 'subscriptionCansel'])->name('subscription.cansel');
});

Route::post('stripe/webhook/invoice-created', [StripeWebhookController::class, 'handleInvoiceCreated']);
Route::post('stripe/webhook/invoice-succeed', [StripeWebhookController::class, 'handleInvoicePaymentSucceeded']);
