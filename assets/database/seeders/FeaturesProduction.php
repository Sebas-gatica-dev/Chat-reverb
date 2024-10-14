<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Module;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FeaturesProduction extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run(): void
        {
            // Eliminar registros de la tabla Featurable del modelo Plan
            DB::table('featureables')->delete(); // Eliminar registros de la tabla Featurable del modelo Plan
            DB::table('module_plan')->delete(); // Eliminar registros de la tabla module_plan
            DB::table('features')->delete(); // Eliminar registros de la tabla features
            DB::table('modules')->delete(); // Eliminar registros de la tabla modules

            // Crear Módulos
            $modulo1 = Module::create([
                'name' => 'Clientes',
                'slug' => 'customer',
                'description' => 'Módulo para gestionar clientes.',
            ]);

            $modulo2 = Module::create([
                'name' => 'Propiedades',
                'slug' => 'property',
                'description' => 'Módulo para gestionar propiedades.',
            ]);

            // Gestión de Clientes
            $featuresCustomer = [
                ['name' => 'Ver Clientes', 'slug' => 'customer-list', 'description' => 'Ver vista de clientes'],
                ['name' => 'Agregar Cliente', 'slug' => 'customer-add', 'description' => 'Agregar un cliente'],
            ];

            $featuresProperty = [
                ['name' => 'Ver Propiedades', 'slug' => 'property-list', 'description' => 'Ver vista de propiedades'],
                ['name' => 'Agregar Propiedad', 'slug' => 'property-add', 'description' => 'Agregar una propiedad'],
                ['name' => 'Agregar fotos', 'slug' => 'property-add-photo', 'description' => 'Agregar una foto a la propiedad'],
                ['name' => 'Agregar teléfonos', 'slug' => 'property-add-phone', 'description' => 'Agregar un teléfono a la propiedad'],
            ];

            foreach ($featuresCustomer as $feature) {
                Feature::create(array_merge($feature, ['module_id' => $modulo1->id]));
            }

            foreach ($featuresProperty as $feature) {
                Feature::create(array_merge($feature, ['module_id' => $modulo2->id]));
            }


            $plan = Plan::where('slug', 'plan-basico')->first();

            //traemos un whereIn de los $featuresClientes, tener en cuenta que es un array y hay que buscar por slug
            $features = Feature::whereIn('slug', array_column($featuresCustomer, 'slug'))->get();
            $features = $features->merge(Feature::whereIn('slug', array_column($featuresProperty, 'slug'))->get());




            //asignamos los features al plan
            $plan->features()->attach($features->pluck('id'));

            $featurePhone = Feature::where('slug', 'property-add-phone')->first();
            if ($featurePhone) {
                $plan->features()->updateExistingPivot($featurePhone->id, ['count' => 3]);
            }
            Cache::flush();
        }

}
