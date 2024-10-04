<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subscription_id' => Subscription::inRandomOrder()->first()->id,
            'payment_method' => 'mercadopago',
            'link' => $this->faker->url,
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'paid_at' => now(),
            'preference_id' => Str::random(10),
            'status' => 1,
            'response' => null,
            'currency' => 'ARS',
            'is_partial' => false,

        ];
    }
}
