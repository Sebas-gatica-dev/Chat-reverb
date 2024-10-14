<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $latitude = null;
        $longitude = null;
        
        do {
            $baseLatitude = -34.62; // Un punto central en Buenos Aires
            $baseLongitude = -58.44; // Un punto central en Buenos Aires
            
            $variationLat = 0.027; // Aproximadamente 3 km de variación en latitud
            $variationLng = 0.0336; // Aproximadamente 3 km de variación en longitud
            
            // Generar coordenadas con mayor precisión
            $latitude = round($baseLatitude + mt_rand(-1000, 1000) / 1000 * $variationLat, 6);
            $longitude = round($baseLongitude + mt_rand(-1000, 1000) / 1000 * $variationLng, 6);
        
            // Margen de tolerancia para evitar colisiones en el almacenamiento (aumenta o reduce según sea necesario)
            $tolerance = 0.0001;
        
            // Verificar si ya existe una propiedad cercana dentro de un rango pequeño
            $existingProperty = \App\Models\Property::whereBetween('latitude', [$latitude - $tolerance, $latitude + $tolerance])
                                                     ->whereBetween('longitude', [$longitude - $tolerance, $longitude + $tolerance])
                                                     ->first();
        } while ($existingProperty); // Repetir mientras haya una propiedad con las mismas coordenadas
        





        return [
            'property_name' => $this->faker->word,
            'property_type' => \App\Models\PropertyType::inRandomOrder()->first(),
            'documentation' => $this->faker->regexify('[0-9]{7,8}'),
            'frequency' => $this->faker->numberBetween(1, 9),
            'branch_id' => \App\Models\Branch::inRandomOrder()->first(),
            'created_by' => \App\Models\User::inRandomOrder()->first(),
            'photo' => $this->faker->imageUrl,
            'address' => $this->faker->address,
            'between_streets' => $this->faker->streetName . ' y ' . $this->faker->streetName,
            'floor' => $this->faker->randomDigitNotNull,
            'apartment' => $this->faker->randomLetter(),
            'country_id' => \App\Models\Country::inRandomOrder()->first(),
            'province_id' => \App\Models\Province::inRandomOrder()->first(),
            'city_id' => \App\Models\City::inRandomOrder()->first(),
            'neighborhood_id' => \App\Models\Neighborhood::inRandomOrder()->first(),
            'subzone_id' => \App\Models\Subzone::inRandomOrder()->first(),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'customer_id' => \App\Models\Customer::inRandomOrder()->first(),
            'business_id' => \App\Models\Business::inRandomOrder()->first(),
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),

        ];
    }
}
