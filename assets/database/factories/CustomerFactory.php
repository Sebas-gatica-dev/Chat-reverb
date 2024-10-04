<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'business_name' => $this->faker->company,
            'gender' => 'male',
            'source' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'email' => $this->faker->safeEmail,
            'created_by' => 1,
            'business_id' => 1,
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),

        ];
    }
}
