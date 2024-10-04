<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear planes
        $basicPlan = Plan::create([
            'name' => 'Plan Básico',
            'slug' => 'plan-basico',
            'description' => 'Descripción del Plan Básico',
            'price' => 100,
            'duration' => 1,
            'duration_unit' => 'month',
            'free_trial_days' => 7,
            'is_featured' => false
        ]);

        $advancedPlan = Plan::create([
            'name' => 'Plan Avanzado',
            'slug' => 'plan-avanzado',
            'description' => 'Descripción del Plan Avanzado',
            'price' => 200,
            'duration' => 1,
            'duration_unit' => 'month',
            'free_trial_days' => 7,
            'is_featured' => true
        ]);

        $premiumPlan = Plan::create([
            'name' => 'Plan Premium',
            'slug' => 'plan-premium',
            'description' => 'Descripción del Plan Premium',
            'price' => 300,
            'duration' => 1,
            'duration_unit' => 'month',
            'free_trial_days' => 7,
            'is_featured' => false
        ]);

        // Asignar features a los planes
        $this->attachFeaturesToPlans($basicPlan, $advancedPlan, $premiumPlan);
    }

    private function attachFeaturesToPlans($basicPlan, $advancedPlan, $premiumPlan)
    {
        

    
            $features = Feature::all();

            // Features para Plan Básico: 5 primeras features de cada módulo
            $basicFeatures = $features->take(5)->pluck('id')->toArray();
            $basicPlan->features()->attach($basicFeatures, ['count' => 3]);

            // Features para Plan Avanzado: 10 primeras features de cada módulo
            $advancedFeatures = $features->take(10)->pluck('id')->toArray();
            $advancedPlan->features()->attach($advancedFeatures, ['count' => 5]);

            // Features para Plan Premium: Todas las features de cada módulo
            $premiumFeatures = $features->pluck('id')->toArray();
            $premiumPlan->features()->attach($premiumFeatures, ['count' => 10]);
        
    }



}
