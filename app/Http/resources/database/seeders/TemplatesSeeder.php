<?php

namespace Database\Seeders;

use App\Models\Logic;
use App\Models\Template;
use App\Models\Widget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Template 1
        $template1 = Template::create([
            'name' => 'Template 1',
            'description' => 'Template con gráficos de Usuarios y Ventas',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'line',
            'title' => 'Clientes',
            'description' => 'Gráfico de clientes',
            'size' => 'small',
            'color' => '#4bc0c0',
            'date' => 'last_6_months',
            'logic' => 'customers',
            'order' => 1,
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'line',
            'title' => 'Clientes potenciales',
            'description' => 'Grafico de clientes potenciales',
            'size' => 'small',
            'color' => '#ff6384',
            'date' => 'this_year',
            'logic' => 'leads',
            'order' => 2,
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'line',
            'title' => 'Visitas',
            'description' => 'Gráfico de visitas',
            'size' => 'small',
            'color' => '#9966ff',
            'date' => 'last_30_days',
            'logic' => 'visits',
            'order' => 3,
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Clientes',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'very_small',
            'color' => '#ff6384',
            'date' => 'this_year',
            'logic' => 'customers',
            'order' => 4,
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Leads',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'very_small',
            'color' => '#ff6384',
            'date' => 'this_year',
            'logic' => 'leads',
            'order' => 5,
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Facturacion',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'very_small',
            'color' => '#ff6384',
            'date' => 'this_year',
            'logic' => 'sales',
            'order' => 6,
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Visitas',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'very_small',
            'color' => '#ff6384',
            'date' => 'this_year',
            'logic' => 'visits',
            'order' => 7,
        ]);

    
    }
}
