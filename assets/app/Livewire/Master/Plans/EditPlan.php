<?php

namespace App\Livewire\Master\Plans;

use App\Livewire\Master\Features\Partials\MultiSelectFeatures;
use App\Livewire\Master\Features\Partials\Modals\ConfirmModalDetachFeature;
use App\Models\Feature;
use App\Models\Module;
use App\Models\Plan;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redis;

class EditPlan extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    public ?Plan $plan;

    #[Validate('required|string|max:120')]
    public $name;
    public $slug;
    #[Validate('required|string|max:1000')]
    public $description;
    #[Validate('required|integer')]
    public $price;
    #[Validate('required|integer')]
    public $duration;
    #[Validate('required')]
    public $duration_unit;
    #[Validate('integer|nullable')]
    public $free_trial_days;
    #[Validate('boolean')]
    public $is_featured;
    public $selectedFeatures = [];
    public $featureDetachID;

    public $selectAll = false;


    public function mount()
    {

        $this->name = $this->plan->name;
        $this->slug = $this->plan->slug;
        $this->description = $this->plan->description;
        $this->price = $this->plan->price;
        $this->duration = $this->plan->duration;
        $this->duration_unit = $this->plan->duration_unit;
        $this->free_trial_days = $this->plan->free_trial_days;
        $this->is_featured = $this->plan->is_featured;

        // $this->selectedFeatures = $this->plan->features->map(function ($feature) {
        //     return ['id' => $feature->id, 'name' => $feature->name];
        // })->toArray();




    }






    public function update()
    {
        $this->validate();
        $this->slug = Str::slug($this->name);

        $this->plan->update(
            $this->only(['name', 'slug', 'description', 'price', 'duration', 'duration_unit', 'free_trial_days', 'is_featured'])
        );

        return $this->redirectRoute('master.plans.index');
    }




    #[On('addFeatures')]
    public function associateFeaturesToPlan($values)
    {

        $module = Module::find($values['module_id']);
        $features = array_column($values['features'], 'id');

        $currentFeatures = $this->plan->features->where('module_id', $module->id)->pluck('id')->toArray();
        foreach ($features as $featureId) {
            if (!in_array($featureId, $currentFeatures)) {
                $this->plan->features()->attach($featureId);
            }
        }

        $this->plan = Plan::find($this->plan->id);

    }


    //Abre ventana modal para confirmar si queremos desasociar especifica una funcion del plan

    public function confirmDetachFeature($featureId)
    {

        // dd($featureId);

        $this->featureDetachID = $featureId;
        $this->dispatch('open-modal', ['name' => 'detachConfirm', 'title' => '¿Desea desasociar esta funcion del plan?', 'type' => 'selectedOne' ])->to(ConfirmModalDetachFeature::class);
    }


    //Desasocia una funcion especifica del plan
    #[On('detach-confirmed')]
    public function detachFeature()
    {

        $this->plan->features()->detach($this->featureDetachID);
        $this->featureDetachID = null;
        $this->dispatch('close-modal', ['name' => 'detachConfirm'])->to(ConfirmModalDetachFeature::class);

        $this->dispatch('refresh-features')->to(MultiSelectFeatures::class);


        Cache::flush();
    }



    #[On('detach-cancelled')]
    public function cancelDetachFeature()
    {
        $this->featureDetachID = null;
        $this->dispatch('close-modal', ['name' => 'detachConfirm'])->to(ConfirmModalDetachFeature::class);
    }

    //Seleccionar todas las funciones
    public function updatedSelectAll($value)
    {

        if ($value) {
            $this->selectedFeatures = $this->plan->features->pluck('id')->toArray();
        } else {
            $this->selectedFeatures = [];
        }
    }

    //Abre ventana modal para confirmar si queremos desasociar las funciones seleccionadas

    public function confirmDetachSelectedFeatures()
    {

        $this->dispatch('open-modal', ['name' => 'detachConfirm', 'title' => '¿Desea desasociar estas funciones del plan?', 'type' => 'selectedMultiple'])->to(ConfirmModalDetachFeature::class);

    }

    //Desasocia las funciones seleccionadas

    #[On('detach-confirmed-multiple')]
    public function detachSelectedAllFeatures()
    {
        foreach ($this->selectedFeatures as $featureId) {
            $this->plan->features()->detach($featureId);
        }
        $this->selectedFeatures = [];
        $this->selectAll = false;
        $this->dispatch('close-modal', ['name' => 'detachConfirm'])->to(ConfirmModalDetachFeature::class);
        $this->dispatch('refresh-features')->to(MultiSelectFeatures::class);


    }

    //Cancela la desasociacion de las funciones seleccionadas

    #[On('detach-cancelled-multiple')]
    public function cancelDetachSelectedAllFeatures()
    {
        $this->featureDetachID = null;
        $this->dispatch('close-modal', ['name' => 'detachConfirm'])->to(ConfirmModalDetachFeature::class);
    }

    public function render()
    {
        return view(
            'livewire.master.plans.edit-plan', [
                'features' => $this->plan->features()->paginate(20),
            ])->layout('layouts.master');
    }
}
