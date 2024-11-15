<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\ProductTypeEnum;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $business = Business::where('name', 'Protegel')->first();
        $user = User::where('email', 'dizeg@gmail.com')->first();

        Product::create([
            'name' => 'Jabon Blanco',
            'slug' => 'jabon-blanco',
            'description' => 'Jabon para lavar ropa, ropa blancal, ropa de color y ropa invisible.',
            'type' => 'administrable',
            'quantity' => 0,
            'business_id' => $business->id,
            'barcode' => '',
            'profit' => 40,
            'cost' => 10,
            'unit_of_measurement' => 'gram',
            'measure' => 12,
            'created_by' => $user->id
        ]);

        Product::create([
            'name' => 'Condones Prime',
            'slug' => 'condones-prime',
            'description' => 'Profilactico de alta calidad, seguro sentis más.',
            'type' => 'single_use',
            'quantity' => 0,
            'business_id' => $business->id,
            'barcode' => '',
            'profit' => 100,
            'cost' => 0,
            'unit_of_measurement' => 'unit',
            'measure' => 13,
            'created_by' => $user->id
        ]);

        Product::create([
            'name' => 'Pulverizador Full',
            'slug' => 'pulverizador-fumigacion',
            'description' => 'Pulverizacion para rociar veneno por diferentes areas de la propiedad.',
            'type' => 'infinite',
            'quantity' => 0,
            'business_id' => $business->id,
            'barcode' => '',
            'profit' => 210,
            'cost' => 40,
            'unit_of_measurement' => 'uses',
            'measure' => 14,
            'created_by' => $user->id
        ]);

        Product::create([
            'name' => 'Atado de Cigarrillos',
            'slug' => 'atado-cigarrillos',
            'description' => 'De fino tabaco los mejores cigarrillos del mercado.', 
            'type' => 'administrable',
            'quantity' => 0,
            'business_id' => $business->id,
            'barcode' => '',
            'profit' => 0,
            'cost' => 0,
            'unit_of_measurement' => 'unit',
            'measure' => 15,
            'created_by' => $user->id
        ]);
    }
}