<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->phoneNumber,
            'tag' => $this->faker->word,
            'type' => $this->faker->boolean(),
            'phoneable_id' => $this->faker->randomNumber(),
            'phoneable_type' => $this->faker->word,
        ];
    }
}
