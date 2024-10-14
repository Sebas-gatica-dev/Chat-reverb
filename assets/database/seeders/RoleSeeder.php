<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin = Role::create([
            'name' => 'Administrador',
            'description' => 'Rol de administrador',
            'business_id' => null,
        ]);

       $vendedor = Role::create([
            'name' => 'Vendedor',
            'description' => 'Rol de vendedor',
            'business_id' => null,
        ]);

       $operario = Role::create([
            'name' => 'Operario',
            'description' => 'Rol de operario',
            'business_id' => null,
        ]);

         $admin->features()->attach(Feature::all()->pluck('id'));

            $vendedor->features()->attach(Feature::take(40)->pluck('id'));

            $operario->features()->attach(Feature::take(20)->pluck('id'));



    }
}
