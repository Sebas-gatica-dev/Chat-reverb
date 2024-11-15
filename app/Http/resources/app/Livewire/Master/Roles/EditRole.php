<?php

namespace App\Livewire\Master\Roles;

use App\Livewire\Master\Features\Partials\MultiSelectFeatures;
use App\Livewire\Master\Features\Partials\Modals\ConfirmModalDetachFeature;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class EditRole extends Component
{
    public ?Role $role;
    public $name;
    public $description;

    public $user;

    public $featureDetachID;
    public $selectedFeatures = [];
    public $selectAll = false;


    public function mount()
    {
        $this->name = $this->role->name;
        $this->description = $this->role->description;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'nullable|string',
        ];
    }

    public function update()
    {
        $this->validate();



        $this->role->update([
            'name' => $this->name,
            'description' => $this->description,
            'created_by' => $this->user,
        ]);



        return $this->redirectRoute('master.roles.index');
    }



    #[On('changeUser')]
    public function changeUser($value)
    {
        $this->user = $value;
    }


    #[On('addFeaturesToRol')]
    public function associateFeaturesToRole($values)
    {
        $featureIds = array_column($values['features'], 'id');


        $this->role->features()->attach($featureIds);

        $this->dispatch('refresh-features-for-rol')->to(MultiSelectFeatures::class);
        Cache::flush();
    }


    //Abre ventana modal para confirmar si queremos desasociar especifica una funcion del plan

    public function confirmDetachFeature($featureId)
    {

        // dd($featureId);

        $this->featureDetachID = $featureId;
        $this->dispatch('open-modal', ['name' => 'detachConfirm', 'title' => '¿Desea desasociar esta funcion del rol?', 'type' => 'selectedOne'])->to(ConfirmModalDetachFeature::class);
    }


    //Desasocia una funcion especifica del plan
    #[On('detach-confirmed')]
    public function detachFeature()
    {

        $this->role->features()->detach($this->featureDetachID);
        $this->featureDetachID = null;
        $this->dispatch('close-modal', ['name' => 'detachConfirm'])->to(ConfirmModalDetachFeature::class);
        $this->dispatch('refresh-features-for-rol')->to(MultiSelectFeatures::class);

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
            $this->selectedFeatures = $this->role->features->pluck('id')->toArray();
        } else {
            $this->selectedFeatures = [];
        }
    }

    //Abre ventana modal para confirmar si queremos desasociar las funciones seleccionadas

    public function confirmDetachSelectedFeaturesForRol()
    {
        $this->dispatch('open-modal', ['name' => 'detachConfirm', 'title' => '¿Desea desasociar estas funciones del rol?', 'type' => 'selectedMultiple'])->to(ConfirmModalDetachFeature::class);
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
        $this->dispatch('refresh-features-for-rol')->to(MultiSelectFeatures::class);
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
        return view('livewire.master.roles.edit-role', [

            'features' => $this->role->features()->paginate(10),
        ])
            ->layout('layouts.master');
    }
}
