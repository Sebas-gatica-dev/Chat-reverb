<?php

namespace App\Livewire\Panel\Settings\Roles\Partials;

use App\Helpers\Notifications;
use App\Livewire\Panel\Settings\Roles\EditRole;
use App\Livewire\Panel\Settings\Roles\Partials\Modals\ConfirmModalNextModuleUnSaved;
use App\Models\Feature;
use App\Models\Role;
use Livewire\Attributes\On;
use Livewire\Component;

class MultiSelectedFeaturesRoles extends Component
{
    public $modules = []; // Módulos del administrador
    public $allFeatures = [];  // Todas las características del administrador
    public $roleFeatures = [];  // Características del rol que se esta editando


    public $selectModule = null;
    public $business;

    public $selectedFeatures = [];

    public $oldestSelectedFeatures = [];    // Características seleccionadas antes de la última actualización

    public $confirmNextModule = false;
    public $role;

    public $tempSelectModule = null;

    public function mount()
    {

        $this->business = auth()->user()->business;
        $this->getModulesAndFeaturesAdmin();
        $this->changeModule($this->modules[0]['id']);
    }

    public function updatedSelectedFeatures()
    {

        $changes = [];

        foreach ($this->selectedFeatures as $featureId => $isSelected) {

            if (!isset($this->oldestSelectedFeatures[$featureId]) && !$isSelected) {
                $changes[$featureId] = false;
            }
        }

        $this->selectedFeatures = array_diff_key($this->selectedFeatures, $changes);
    }


    public function getModulesAndFeaturesAdmin()
    {
        $adminRole = $this->business->roles()->where('name', 'Administrador')->first();

        // Obtener todas las características del administrador
        $adminFeatures = $adminRole->features()->with('module')->get();


        // Agrupar todas las características por módulo

        $grouped = $adminFeatures->groupBy('module.id');



        // Obtener las características del rol que se está editando
        $this->roleFeatures = $this->getFeaturesRol();




        // Convertir a un array más simple para la vista
        $this->modules = $grouped->map(function ($features, $moduleId) {
            return [
                'id' => $moduleId,
                'name' => $features->first()->module->name,
                'features' => $features->map(function ($feature) {
                    return [
                        'id' => $feature->id,
                        'name' => $feature->name,
                        'description' => $feature->description,
                    ];
                })->toArray(),
            ];
        })->values()->toArray();

        //dd($this->modules);

        // Almacenar todas las características en una lista plana
        $this->allFeatures = $adminFeatures->map(function ($feature) {
            return [
                'id' => $feature->id,
                'name' => $feature->name,
                'description' => $feature->description,
                'module_id' => $feature->module->id,
            ];
        })->toArray();
    }

    public function getFeaturesRol()
    {


        $allFeaturesRol = $this->business->roles()->where('id', $this->role->id)->first()->features()->get();

        return $allFeaturesRol->map(function ($feature) {
            return [
                'id' => $feature->id,
                'name' => $feature->name,
                'description' => $feature->description,
            ];
        })->toArray();
    }

    //Para moviles
    public function updatedSelectModule($module)
    {


        $this->changeModule($module);
    }



    //Para escritorio
    public function changeModule($module)
    {

        if ($this->selectedFeatures == $this->oldestSelectedFeatures || $this->confirmNextModule) {

            $this->selectModule = $module;
            $this->tempSelectModule = $this->selectModule;
            $features = [];

            foreach ($this->modules as $module) {
                if ($module['id'] == $this->selectModule) {
                    $features = $module['features'];
                }
            }



            // Marcar las características del módulo seleccionado que pertenecen al rol que estás editando
            $this->selectedFeatures = array_fill_keys(array_intersect(array_column($features, 'id'), array_column($this->roleFeatures, 'id')), true);
            $this->oldestSelectedFeatures = $this->selectedFeatures;
            $this->confirmNextModule = false;
        } else {

            $this->dispatch('open-modal', [
                'title' => 'Cambiar de módulo',
                'description' => 'Si cambias de módulo, perderás los cambios no guardados. ¿Deseas continuar?',
                'module' => $module,
            ])->to(ConfirmModalNextModuleUnSaved::class);
        }
    }

    public function updateFeaturesRole()
    {


        $ids = (array_column($this->roleFeatures, 'id'));

        $current_ids = array_flip(array_column($this->roleFeatures, 'id'));


        // Recorrer el array $array y agregar IDs que no están en $ids y son true
        foreach ($this->selectedFeatures as $id => $value) {

            // Si la característica está en selectedFeatures y está marcada como true, la mantenemos
            if ($value === true && isset($current_ids[$id])) {
                continue;
            }
            // Si la característica está en selectedFeatures y está marcada como false, la removemos
            elseif ($value === false && isset($current_ids[$id])) {
                unset($ids[$current_ids[$id]]);
            } elseif ($value === true && !isset($current_ids[$id])) {
                $ids[] = $id;
            }
        }

      //  dd($ids, $this->roleFeatures);


        $this->dispatch('updateFeaturesRole', values: $ids)->to(EditRole::class);
    }
    #[On('refresh-features-for-rol')]
    public function updateInitialAllFeatures()
    {
        $this->getModulesAndFeaturesAdmin();
        $this->selectedFeatures = [];
        $this->oldestSelectedFeatures = [];

        $this->changeModule($this->selectModule);

        $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Funciones actualizadas correctamente.']);
    }



    #[On('next-confirmed-module')]
    public function confirmNextModule($module)
    {


        $this->dispatch('close-modal')->to(ConfirmModalNextModuleUnSaved::class);
        $this->confirmNextModule = true;
        $this->changeModule($module['id']);
    }


    // #[On('cancel-confirmed-module')]
    // public function cancelConfirmedModule($module)
    // {


    //     $this->dispatch('close-modal')->to(ConfirmModalNextModuleUnSaved::class);
    //     $this->confirmNextModule = true;
    //     $this->changeModule($module['id']);
    // }

    #[On('cancel-confirmed-module')]
    public function cancelConfirmedModule()
    {
        // dd($this->tempSelectModule, $this->selectModule);
        //$this->dispatch('close-modal')->to(ConfirmModalNextModuleUnSaved::class); // Restaurar el valor original
        $this->selectModule = $this->tempSelectModule;
    }

    // public function toggleFeatureSelected($featureId)
    // {

    //     $this->selectedFeatures = array_keys($this->selectedFeatures);
    //     $elementoEncontrado = array_filter($this->modules, function ($elemento) {
    //         return $elemento['id'] === $this->selectModule;
    //     });
    //     $featuresModuleSelected = $elementoEncontrado[0]['features'];

    //     $featuresModuleSelected = array_column($featuresModuleSelected, 'id');


    //     $featureKey = array_search($featureId, $this->selectedFeatures);
    //     dd($featureKey);

    //     if ($featureKey !== false) {
    //         unset($this->selectedFeatures[$featureKey]);

    //     } else {
    //         $filteredFeatures = array_filter($featuresModuleSelected, fn ($feature) => $feature == $featureId);


    //         if (!empty($filteredFeatures)) {
    //             $this->selectedFeatures[] = reset($filteredFeatures);
    //         }

    //     }

    //     $this->selectedFeatures = array_values($this->selectedFeatures);
    // }

    public function toggleFeatureSelected($featureId)
    {
        if (isset($this->selectedFeatures[$featureId])) {
            $this->selectedFeatures[$featureId] = !$this->selectedFeatures[$featureId];
        } else {
            $this->selectedFeatures[$featureId] = true;
        }

        // Filtrar selectedFeatures para eliminar las características no seleccionadas
            // $this->selectedFeatures = array_filter($this->selectedFeatures, function ($isSelected) {
            //     return $isSelected;
            //  });

           $this->updatedSelectedFeatures();



    }
    // public function selectAllFeatures()
    // {
    //     // Obtener las características del módulo seleccionado
    //     $features = array_filter($this->allFeatures, function ($feature) {
    //         return $feature['module_id'] == $this->selectModule;
    //     });

    //     // Verificar si todas las características ya están seleccionadas
    //     $allSelected = true;
    //     foreach ($features as $feature) {
    //         if (!isset($this->selectedFeatures[$feature['id']]) || !$this->selectedFeatures[$feature['id']]) {
    //             $allSelected = false;
    //             break;
    //         }
    //     }

    //     // Alternar el estado de todas las características
    //     foreach ($features as $feature) {
    //         if ($allSelected) {
    //             unset($this->selectedFeatures[$feature['id']]);
    //         } else {
    //             $this->selectedFeatures[$feature['id']] = true;
    //         }
    //     }

    //     // Filtrar selectedFeatures para eliminar las características no seleccionadas
    //     $this->selectedFeatures = array_filter($this->selectedFeatures, function ($isSelected) {
    //         return $isSelected;
    //     });
    // }

    public function selectAllFeatures()
    {
        $features = array_filter($this->allFeatures, function ($feature) {
            return $feature['module_id'] == $this->selectModule;
        });

        $allSelected = true;
        foreach ($features as $feature) {
            if (!isset($this->selectedFeatures[$feature['id']]) || !$this->selectedFeatures[$feature['id']]) {
                $allSelected = false;
                break;
            }
        }

        foreach ($features as $feature) {
            $this->selectedFeatures[$feature['id']] = !$allSelected;
        }
    }


    public function render()
    {
        return view('livewire.panel.settings.roles.partials.multi-selected-features-roles');
    }
}
