<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhookController extends WebhookController
{
    public function handleInvoiceCreated($payload)
    {
        Log::debug('event created', $payload);
        $data = $payload['data']['object'];
        $user = User::where('stripe_id', $data['customer'])->first();

        if ($user){
            Invoice::create([
                'user_id' => $user->id,
                'total' => $data['total'],
                'stripe_id' => $data['lines']['data'][0]['id'],
                'status' => 'created',
            ]);
            return new Response('Webhook Handled', 200);
        }
        else{
            return new Response('Webhook Handled', 500);
        }
    }

    public function handleInvoicePaymentSucceeded($payload)
    {
        $data = $payload['data']['object'];
        $invoice = Invoice::where('stripe_id', $data['lines']['data'][0]['id'])->first();

        if ($invoice){
            $invoice->status = 'paid';
            $invoice->save();
        }
        return new Response('Webhook Handled', 200);
    }
}
