<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plan_id' => Plan::inRandomOrder()->first()->id,
            'business_id' => Business::inRandomOrder()->first()->id,
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
            'status' => 1,
            'payment_method' => 'mercado_pago',

        ];
    }
}
