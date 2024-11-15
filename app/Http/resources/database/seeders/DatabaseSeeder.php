<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Module;
use App\Models\Neighborhood;
use App\Models\Plan;
use App\Models\Product;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Subzone;
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

        if (env('APP_ENV') === 'production') {


            $this->call([
                CountrySeeder::class,
                ProvinceSeeder::class,
                CitySeeder::class,
                NeighborhoodSeeder::class,
                SubzoneSeeder::class,
                TemplatesSeeder::class,
                IndustrySeeder::class,
                ModuleSeeder::class,
                FeatureSeeder::class,
                PlanSeeder::class,
                RoleSeeder::class,
                // BusinessSeeder::class,
                // WarehouseSeeder::class,
                // ProductSeeder::class,
            ]);
        } else {
            $this->call([
                CountrySeeder::class,
                // ProvinceSeeder::class,
                // CitySeeder::class,
                // NeighborhoodSeeder::class,
                // SubzoneSeeder::class,
                ZonesTestSeeder::class,
                TemplatesSeeder::class,
                IndustrySeeder::class,
                ModuleSeeder::class,
                FeatureSeeder::class,
                PlanSeeder::class,
                RoleSeeder::class,
                BusinessSeeder::class,
                WarehouseSeeder::class,
                ProductSeeder::class,
            ]);
        }
    }
}
