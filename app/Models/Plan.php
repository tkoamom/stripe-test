<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'stripe_plan',
        'description'
    ];

    public function getRouteKeyName()
    {
        return parent::getRouteKeyName(); // TODO: Change the autogenerated stub
    }
}
