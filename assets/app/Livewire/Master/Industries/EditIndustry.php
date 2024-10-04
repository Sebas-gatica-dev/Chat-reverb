<?php

namespace App\Livewire\Master\Industries;

use App\Livewire\Master\Features\Partials\MultiSelectFeatures;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditIndustry extends Component
{

    public ?Industry $industry;

    #[Validate('required|string|max:120')]
    public $name;

    public $selectedFeatures = [];
    public $selectAll = false;


    public function mount()
    {
        $this->name = $this->industry->name;


    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:120',
        ]);

        $this->industry->update([
            'name' => $this->name,
        ]);

        return redirect()->route('master.industries.edit', $this->industry->id);
    }

    public function updatedSelectAll($value)
    {

        if ($value) {
            $this->selectedFeatures = $this->loadFeaturesIndustry()->pluck('id')->toArray();
        } else {
            $this->selectedFeatures = [];
        }
    }


    #[On('addFeaturesToIndustry')]
    public function associateFeaturesToBusiness($values)
    {

        // Lógica para asociar las funciones seleccionadas al negocio
        $featureIds = array_column($values['features'], 'id');
        $planId = $values['plan_id'];



        $planFeaturable = Plan::find($planId);

        $planFeaturable->features()->attach($featureIds, ['industry_id' => $this->industry->id]);


        $this->dispatch('refresh-features-for-industry')->to(MultiSelectFeatures::class);

        $this->selectAll = false;
        $this->selectedFeatures = [];
    }

    public function confirmDetachSelectFeatureForIndustry($idFeature){
        DB::table('featureables')
            ->where('feature_id', $idFeature)
            ->where('industry_id', $this->industry->id)
            ->where('featureable_type', Plan::class) // Asegúrate de usar el namespace completo del modelo Plan
            ->delete();
            $this->dispatch('refresh-features-for-industry')->to(MultiSelectFeatures::class);
            $this->selectAll = false;
            $this->selectedFeatures = [];
    }


    public function confirmDetachSelectedFeaturesForIndustry(){


        // Verifica que selectedFeatures no esté vacío
        if (!empty($this->selectedFeatures)) {
            // Elimina los registros de la tabla pivot featureables
            DB::table('featureables')
                ->whereIn('feature_id', $this->selectedFeatures)
                ->where('industry_id', $this->industry->id)
                ->where('featureable_type', Plan::class) // Asegúrate de usar el namespace completo del modelo Plan
                ->delete();
        }
        $this->dispatch('refresh-features-for-industry')->to(MultiSelectFeatures::class);
        $this->selectAll = false;
        $this->selectedFeatures = [];

    }

    public function loadFeaturesIndustry(){
      return  Feature::whereHas('industries', function ($query) {
            $query->where('industry_id', $this->industry->id);
        });

    }

    public function render()
    {
        return view(
            'livewire.master.industries.edit-industry',
            [
                'features' => $this->loadFeaturesIndustry()->paginate(6)
            ]
        )
            ->layout('layouts.master', ['header' => 'Edit Industry']);
    }
}
