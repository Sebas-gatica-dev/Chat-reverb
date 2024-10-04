<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Module;
use App\Models\Plan;
use App\Models\PropertyType;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CountrySeeder::class,

            // PROVINCIAS, CIUDADES, BARRIOS Y SUBZONAS DE PRODUCCIÓN
            // ProvinceSeeder::class,
            // CitySeeder::class,
            // NeighborhoodSeeder::class,
            // SubzoneSeeder::class,

            // PROVINCIAS, CIUDADES, BARRIOS Y SUBZONAS DE PRUEBA

            ZonesTestSeeder::class,

        ]);



        $this->call([
            TemplatesSeeder::class,
            IndustrySeeder::class,
            ModuleSeeder::class,
            FeatureSeeder::class,
            PlanSeeder::class,
            RoleSeeder::class,
            BusinessSeeder::class,
            // FeatureablesTableSeeder::class,
        ]);
    }
}
