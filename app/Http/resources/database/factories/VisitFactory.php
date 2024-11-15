<?php

namespace Database\Factories;

use App\Enums\PaymentMethodEnum;
use App\Enums\StatusVisitEnum;
use App\Models\Customer;
use App\Models\Property;
use App\Models\VisitType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween(Carbon::now(), Carbon::now()->addDays(30)),
            'time' => $this->faker->time(),
            'price' => number_format($this->faker->randomFloat(2, 0, 99999), 2, ',', '.'),
            'iva' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(array_column(StatusVisitEnum::cases(), 'value')),
            'expected_payment' => $this->faker->randomElement(array_column(PaymentMethodEnum::cases(), 'value')),
            'visit_type_id' => VisitType::all()->random()->id,
            'property_id' => Property::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'duration_time' => 45,
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),

        ];
    }
}
