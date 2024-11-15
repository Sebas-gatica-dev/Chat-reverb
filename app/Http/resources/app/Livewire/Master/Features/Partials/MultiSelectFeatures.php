<?php

namespace App\Livewire\Master\Features\Partials;

use App\Livewire\Master\Businesses\EditBusiness;
use App\Livewire\Master\Industries\EditIndustry;
use App\Livewire\Master\Plans\EditPlan;
use App\Livewire\Master\Roles\EditRole;
use App\Models\Feature;
use App\Models\Module;
use App\Models\Plan;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class MultiSelectFeatures extends Component
{
    public $modules;
    public $selectedModule = null;
    public $features = [];
    public $selectedFeatures = [];
    public $associatedFeatureIds = [];

    public $plan;

    public $business;

    public $industry;

    public $plans;

    public $role;

    public $selectedIndustryPlan;


    public function mount()
    {
        $this->modules = Module::all();

        if ($this->plan) {

            $this->refreshFeaturesPlan();
        } elseif ($this->business) {

            $this->filterSelectedFeaturesForBusiness();
        } elseif ($this->industry) {



            $this->plans = Plan::all();
        }elseif($this->role){
            $this->refreshFeaturesRol();
        }
    }



    public function updatedSelectedIndustryPlan()
    {
        $this->modules = Module::all();

        $this->reset('selectedModule', 'features', 'selectedFeatures');
        // $this->refreshFeatures();
    }


    #[On('refresh-features')]
    public function refreshFeaturesPlan($plan = null)
    {

        if ($plan) {
            $this->plan = $plan; //es el plan actualizado
        }
        $this->associatedFeatureIds = $this->plan->features->pluck('id')->toArray();


        if (!empty($this->modules)) {
            //$this->selectedModule = $this->modules->first()->id;
            $this->loadFeatures();
        }
    }


    public function updatedSelectedModule()
    {

        if ($this->industry) {

            $this->reset('features', 'selectedFeatures');

            $this->filterSelectedFeaturesForIndustry();
        } else {
            $this->loadFeatures();
        }
    }


    public function loadFeatures()
    {
        if ($this->selectedModule) {
            $this->features = Feature::where('module_id', $this->selectedModule)
                ->whereNotIn('id', $this->associatedFeatureIds)
                ->get()
                ->toArray();
            // $this->selectedFeatures = $this->features;
        }
    }

    public function selectAllFeatures()
    {
        if (count($this->selectedFeatures) === count($this->features)) {
            $this->selectedFeatures = [];
        } else {
            $this->selectedFeatures = $this->features;
        }
    }

    // public function toggleFeatureSelected($featureId)
    // {
    //     $featureKey = array_search($featureId, array_column($this->selectedFeatures, 'id'));

    //     if ($featureKey !== false) {
    //         unset($this->selectedFeatures[$featureKey]);
    //     } else {
    //         $this->selectedFeatures[] = array_filter($this->features, fn ($feature) => $feature['id'] == $featureId)[0];
    //     }

    //     $this->selectedFeatures = array_values($this->selectedFeatures);
    // }

    public function toggleFeatureSelected($featureId)
    {
        $featureKey = array_search($featureId, array_column($this->selectedFeatures, 'id'));

        if ($featureKey !== false) {
            unset($this->selectedFeatures[$featureKey]);
        } else {
            $filteredFeatures = array_filter($this->features, fn ($feature) => $feature['id'] == $featureId);

            if (!empty($filteredFeatures)) {
                $this->selectedFeatures[] = reset($filteredFeatures);
            }
        }

        $this->selectedFeatures = array_values($this->selectedFeatures);
    }


    public function addModuleToPlan()
    {
        $this->dispatch('addFeatures', values: [

            'module_id' => $this->selectedModule,
            'features' => $this->selectedFeatures,
        ])->to(EditPlan::class);

        // Actualizar la lista de funciones asociadas
        $this->associatedFeatureIds = array_merge($this->associatedFeatureIds, array_column($this->selectedFeatures, 'id'));

        // Limpiar las funciones seleccionadas
        $this->selectedFeatures = [];
        $this->loadFeatures();
        Cache::flush();
    }

    public function addFeaturesToBusiness()
    {


        $this->dispatch('addFeaturesToBusiness', values: [
            'features' => $this->selectedFeatures,
        ])->to(EditBusiness::class);

        // Limpiar las funciones seleccionadas
        $this->selectedFeatures = [];
        $this->filterSelectedFeaturesForBusiness();
    }
    #[On('refresh-features-for-business')]
    public function filterSelectedFeaturesForBusiness()
    {

        $this->features = Feature::get()->toArray(); //todas las funciones



        $planFeatures = [];
        $industryFeatures = [];
        $businessFeatures = [];


        // Verificar si el negocio tiene un plan asociado
        if ($this->business->plan) {

            $planFeatures = $this->business->plan->features->pluck('id')->toArray();
        }


        // Verificar si el negocio tiene funciones de industria asociadas
        if ($this->business->industry && $this->business->plan) {
            $industryFeatures = $this->business->plan->featuresIndustry($this->business->industry->id)->pluck('id')->toArray();
        }


        // Verificar si el negocio tiene funciones asociadas
        if ($this->business->features()->exists()) {
            $businessFeatures = $this->business->features->pluck('id')->toArray();
        }

        // Debugging para verificar las características seleccionadas;
        // Filtrar las funciones del módulo seleccionadas
        $this->features = array_filter($this->features, function ($feature) use ($planFeatures, $industryFeatures, $businessFeatures) {
            return !in_array($feature['id'], $planFeatures) && !in_array($feature['id'], $industryFeatures) && !in_array($feature['id'], $businessFeatures);
        });
    }


    #[On('refresh-features-for-industry')]
    public function filterSelectedFeaturesForIndustry()
    {

        // Obtener todas las features en una colección
        $this->features = Feature::where('module_id', $this->selectedModule)->get()->toArray();

        // Verificar que el plan seleccionado no sea null
        $planFeatures= Plan::find($this->selectedIndustryPlan);
        $industryFeatures = Plan::find($this->selectedIndustryPlan);


        if($planFeatures) {
            // Obtener las features del plan seleccionado y el módulo seleccionado
            $planFeatures = $planFeatures
                ->features()
                ->where('module_id', $this->selectedModule)
                ->pluck('id')
                ->toArray();
        }else{
            $planFeatures = [];
        }

        if($industryFeatures) {
            // Obtener las features del plan seleccionado, el módulo seleccionado y la industria seleccionada
            $industryFeatures = $industryFeatures
                ->featuresIndustry($this->industry->id)
                ->where('module_id', $this->selectedModule)
                ->pluck('id')
                ->toArray();
        }else{
            $industryFeatures = [];
        }


        $this->features = array_filter($this->features, function ($feature) use ($planFeatures, $industryFeatures) {
            return !in_array($feature['id'], $planFeatures) && !in_array($feature['id'], $industryFeatures);
        });
    }

    public function addFeaturesToIndustry()
    {

        $this->dispatch('addFeaturesToIndustry', values: [
            'features' => $this->selectedFeatures,
            'plan_id' => $this->selectedIndustryPlan,
        ])->to(EditIndustry::class);

        // Limpiar las funciones seleccionadas
        $this->selectedFeatures = [];
        $this->filterSelectedFeaturesForIndustry();
    }


    #[On('refresh-features-for-rol')]
    public function refreshFeaturesRol($rol = null)
    {
        if ($rol) {
            $this->role = $rol; //es el rol actualizado
        }
        $this->associatedFeatureIds = $this->role->features->pluck('id')->toArray();

    }

    public function addFeaturesToRol()
    {
        $this->dispatch('addFeaturesToRol', values: [
            'features' => $this->selectedFeatures,
        ])->to(EditRole::class);
        // Actualizar la lista de funciones asociadas
        $this->associatedFeatureIds = array_merge($this->associatedFeatureIds, array_column($this->selectedFeatures, 'id'));

        // Limpiar las funciones seleccionadas
        $this->selectedFeatures = [];
        $this->loadFeatures();
        Cache::flush();
    }

    public function render()
    {

        return view('livewire.master.features.partials.multi-select-features');
    }
}
