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
            'type' => 'bar',
            'title' => 'Usuarios',
            'description' => 'Muestra el número de usuarios activos',
            'size' => 'cuatro',
            'color' => '#4bc0c0',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'UsersLogic',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'line',
            'title' => 'Comentarios',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'cuatro',
            'color' => '#ff6384',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'CommentsLogic',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'line',
            'title' => 'Visitas',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'cuatro',
            'color' => '#ff6384',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'VisitsLogic',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Comentarios',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'tres',
            'color' => '#ff6384',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'CommentsLogic',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Usuarios',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'tres',
            'color' => '#ff6384',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'UsersLogic',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Clientes',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'tres',
            'color' => '#ff6384',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'PropertysLogic',
        ]);

        Widget::create([
            'template_id' => $template1->id,
            'type' => 'count',
            'title' => 'Visitas',
            'description' => 'Gráfico de ventas totales por mes',
            'size' => 'tres',
            'color' => '#ff6384',
            'date_range' => json_encode(['start' => '2024-01', 'end' => '2024-12']),
            'logic' => 'VisitsLogic',
        ]);

    
    }
}
