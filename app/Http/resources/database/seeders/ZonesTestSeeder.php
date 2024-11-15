<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Province;
use App\Models\Subzone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonesTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $provincias = Province::factory()->count(10)->create();

            $provincias->each(function ($provincia) {
                $ciudades = City::factory()->count(10)->create([
                    'province_id' => $provincia->id,
                ]);

                $ciudades->each(function ($ciudad) {
                    $barrios = Neighborhood::factory()->count(10)->create([
                        'city_id' => $ciudad->id,
                    ]);

                    $barrios->each(function ($barrio) {
                        // Si el id del barrio es par entonces crear 10 subzonas
                        if ($barrio->id % 2 === 0) {
                            Subzone::factory()->count(10)->create([
                                'neighborhood_id' => $barrio->id,
                            ]);
                        }
                    });
                });
            });
        });
    }
}
