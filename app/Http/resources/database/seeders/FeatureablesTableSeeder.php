<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::find('plan-1');
        $business = Business::find('business-1');
        $features = Feature::pluck('id');

        foreach ($features as $featureId) {
            $plan->features()->attach($featureId, [
                'id' => (string) Str::uuid(),
            ]);

            $business->features()->attach($featureId, [
                'id' => (string) Str::uuid(),
                'industry_id' => 'industry-1',
            ]);
        }
    }
}
