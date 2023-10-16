<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeWebhookController extends WebhookController
{
    public function handleInvoiceCreated($payload)
    {
        $data = $payload['data']['object'];
        $user = User::where('stripe_id', $data['customer'])->first();

        if ($user){
            Invoice::create([
                'user_id' => $user->id,
                'total' => $data['amount'],
                'stripe_id' => $data['lines']['data']['id'],
                'status' => 'created',
            ]);
        }
    }

    public function handleInvoicePaymentSucceeded($payload)
    {
        $data = $payload['data']['object'];
        $invoice = Invoice::where('stripe_id', $data['lines']['data']['id'])->first();

        if ($invoice){
            $invoice->status = 'paid';
            $invoice->save();
        }
    }
}
