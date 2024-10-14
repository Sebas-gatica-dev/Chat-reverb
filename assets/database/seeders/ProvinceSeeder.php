<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::create([
            'id' => 1,
            'name' => 'Capital Federal',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 2,
            'name' => 'GBA Norte',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 3,
            'name' => 'GBA Sur',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 4,
            'name' => 'Provincia de Buenos Aires',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 5,
            'name' => 'Buenos Aires Costa Atlantica',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 6,
            'name' => 'Catamarca',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 7,
            'name' => 'Chaco',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 8,
            'name' => 'Corrientes',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 9,
            'name' => 'Córdoba',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 10,
            'name' => 'Entre Ríos',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 11,
            'name' => 'Formosa',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 12,
            'name' => 'GBA Oeste',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 13,
            'name' => 'Jujuy',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 14,
            'name' => 'La Pampa',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 15,
            'name' => 'La Rioja',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 16,
            'name' => 'Mendoza',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 17,
            'name' => 'Misiones',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 18,
            'name' => 'Neuquen',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 19,
            'name' => 'Rio Negro',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 20,
            'name' => 'Salta',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 21,
            'name' => 'San Juan',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 22,
            'name' => 'San Luis',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 23,
            'name' => 'Santa Cruz',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 24,
            'name' => 'Santiago del Estero',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 25,
            'name' => 'Tierra del Fuego',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 26,
            'name' => 'Tucuman',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 27,
            'name' => 'Santa fe',
            'country_id' => 1,
        ]);

        Province::create([
            'id' => 28,
            'name' => 'Chubut',
            'country_id' => 1,
        ]);
    }
}
