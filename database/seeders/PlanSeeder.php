<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'stripe_plan' => 'price_1O0MsvGAUIWlFlizbAx6s4Dr',
                'price' => 5,
                'description' => 'Basic'
            ],
            [
                'name' => 'Standart',
                'slug' => 'standart',
                'stripe_plan' => 'price_1O0LYpGAUIWlFlizKYsd3yKv',
                'price' => 15,
                'description' => 'Standart'
            ],
            [
                'name' => 'Premium',
                'slug' => 'premium',
                'stripe_plan' => 'price_1O0LZZGAUIWlFlizfLLIADDQ',
                'price' => 25,
                'description' => 'Premium'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
