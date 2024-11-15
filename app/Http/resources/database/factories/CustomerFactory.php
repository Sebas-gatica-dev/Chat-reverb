<?php

namespace Database\Factories;

use App\Enums\SourceEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
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
            'date_lead' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),
            'time_lead' => $this->faker->time(),
            'type_contact' => $this->faker->randomElement(array_column(TypeContactEnum::cases(), 'value')),
            'status' => $this->faker->randomElement(array_column(StatusCustomerEnum::cases(), 'value')),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'business_name' => $this->faker->company,
            'gender' => 'male',
            'source' => $this->faker->randomElement(array_column(SourceEnum::cases(), 'value')),
            'email' => $this->faker->safeEmail,
            'created_by' => 1,
            'business_id' => 1,
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),

        ];
    }
}
