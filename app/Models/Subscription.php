<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function getUserSubscription(User $user){
        return $this->where('user_id', $user->id)->where('stripe_status', 'active')->first();
    }

    public function plan(){
        return $this->hasOne(Plan::class, 'stripe_plan', 'stripe_price');
    }
}
