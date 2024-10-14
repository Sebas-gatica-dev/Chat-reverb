<?php

namespace Database\Factories;

use App\Models\Industry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name' => $this->faker->unique()->company,
            'logo' => $this->faker->imageUrl(640, 640, 'business'),
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            // 'address' => $this->faker->address,
            'industry_id' => Industry::inRandomOrder()->first()->id,
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
