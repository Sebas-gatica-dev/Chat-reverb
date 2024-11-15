<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lead;
use App\Models\User;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Subzone;
use App\Models\PropertyType;
use App\Models\Service;
use App\Models\Branch;
use App\Models\Business;
use App\Models\Customer;

use Illuminate\Support\Str;
use App\Enums\SourceEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Lead::class;
    public function definition()
    {
        // Fetch or create related models
        $country = Country::inRandomOrder()->first() ?? Country::factory()->create();
        $province = Province::inRandomOrder()->first() ?? Province::factory()->create(['country_id' => $country->id]);
        $city = City::inRandomOrder()->first() ?? City::factory()->create(['province_id' => $province->id]);
        $neighborhood = Neighborhood::inRandomOrder()->first() ?? Neighborhood::factory()->create(['city_id' => $city->id]);
        $subzone = Subzone::inRandomOrder()->first() ?? Subzone::factory()->create(['neighborhood_id' => $neighborhood->id]);
        $propertyType = PropertyType::inRandomOrder()->first() ?? PropertyType::factory()->create();
        $service = Service::inRandomOrder()->first() ?? Service::factory()->create();
        $branch = Branch::inRandomOrder()->first() ?? Branch::factory()->create();
        $createdBy = User::inRandomOrder()->first() ?? User::factory()->create();
        $business = Business::inRandomOrder()->first() ?? Business::factory()->create();
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();

        return [
            'id' => $this->faker->uuid(),
            'date' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),
            'time' => $this->faker->time(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->phoneNumber(),
            'source' => $this->faker->randomElement(array_column(SourceEnum::cases(), 'value')),
            'type_contact' => $this->faker->randomElement(array_column(TypeContactEnum::cases(), 'value')),
            'status' => $this->faker->randomElement(array_column(StatusCustomerEnum::cases(), 'value')),
            'description' => $this->faker->sentence(),
            'country_id' => $country->id,
            'province_id' => $province->id,
            'city_id' => $city->id,
            'neighborhood_id' => $neighborhood->id,
            'subzone_id' => $subzone->id,
            'property_type_id' => $propertyType->id,
            'service_id' => $service->id,
            'branch_id' => $branch->id,
            'created_by' => $createdBy->id,
            'business_id' => $business->id,
            'customer_id' => $customer->id,
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),

        ];
    }
}
