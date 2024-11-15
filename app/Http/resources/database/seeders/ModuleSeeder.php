<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Module;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Crear Módulos

        $modules = [
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'description' => 'Accesso a dashboard.',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Accesso a Business.',
            ],
            [
                'name' => 'Search',
                'slug' => 'search-main',
                'description' => 'Módulo para gestionar el buscador principal.',
            ],
            [
                'name' => 'Clientes',
                'slug' => 'customers',
                'description' => 'Módulo para gestionar clientes.',
            ],
            [
                'name' => 'Propiedades',
                'slug' => 'properties',
                'description' => 'Módulo para gestionar propiedades.',
            ],
            [
                'name' => 'Telefonos',
                'slug' => 'phones',
                'description' => 'Módulo para gestionar telefonos.',
            ],
            [
                'name' => 'Servicios',
                'slug' => 'services',
                'description' => 'Módulo para gestionar servicios.',
            ],
            [
                'name' => 'Zonas',
                'slug' => 'zones',
                'description' => 'Módulo para gestionar zonas.',
            ],
            [
                'name' => 'Cuentas bancarias',
                'slug' => 'bank-accounts',
                'description' => 'Módulo para gestionar cuentas bancarias.',
            ],
            [
                'name' => 'Tipos de visitas',
                'slug' => 'visit-types',
                'description' => 'Módulo para gestionar tipos de visitas.',
            ],
            [
                'name' => 'Tipos de propiedades',
                'slug' => 'property-types',
                'description' => 'Módulo para gestionar tipos de propiedades.',
            ],
            [
                'name' => 'Usuarios',
                'slug' => 'users',
                'description' => 'Módulo para gestionar usuarios.',
            ],
            [
                'name' => 'Roles',
                'slug' => 'roles',
                'description' => 'Módulo para gestionar roles.',
            ],
            [
                'name' => 'Suscripciones',
                'slug' => 'subscriptions',
                'description' => 'Módulo para gestionar suscripciones.',
            ],
            [
                'name' => 'Sucursales',
                'slug' => 'branches',
                'description' => 'Módulo para gestionar sucursales.',
            ],
            [
                'name' => 'Visitas',
                'slug' => 'visits',
                'description' => 'Módulo para gestionar visitas.',
            ],
            [
                'name' => 'Configuraciones',
                'slug' => 'settings',
                'description' => 'Módulo para gestionar las configuraciones.',
            ],
            [
                'name' => 'Papelera',
                'slug' => 'trash',
                'description' => 'Módulo para gestionar la papelera.',
            ],
            [
                'name' => 'Leads',
                'slug' => 'leads',
                'description' => 'Módulo para gestionar Clientes.',
            ],
            [
                'name' => 'Presupuestos',
                'slug' => 'budgets',
                'description' => 'Módulo para gestionar presupuestos.',
            ],
            [
                'name' => 'Stock',
                'slug' => 'stock',
                'description' => 'Módulo para gestionar el stock de los insumos y productos.',
            ],

            
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
