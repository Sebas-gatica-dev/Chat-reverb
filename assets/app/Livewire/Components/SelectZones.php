<?php

namespace App\Livewire\Components;

use App\Helpers\Notifications;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Province;
use App\Models\Subzone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SelectZones extends Component
{

    public $provincias;
    public $ciudades;
    public $barrios;
    public $subzonas;
    public $selectedProvincia = null;
    public $selectedCiudades = [];
    public $selectedBarrios = [];
    public $selectedSubzonas = [];
    public $selectedZones = [];
    public $model;
    public $provincesBusiness;

    public function mount()
    {



        foreach ($this->model->provinces as $provincia) {
            $ciudades = $this->model->cities->where('city.province_id', $provincia->province_id);
            $neighborhoods = $this->model->neighborhoods->whereIn('neighborhood.city_id', $ciudades->pluck('city_id'));
            $subzones = $this->model->subzones->whereIn('subzone.neighborhood_id', $neighborhoods->pluck('neighborhood_id'));

            $this->selectedZones[] = [
                'provincia' => [
                    'id' => $provincia->province->id,
                    'name' => $provincia->province->name
                ],
                'ciudades' => $ciudades->map(function ($ciudad) {
                    return [
                        'id' => $ciudad->city->id,
                        'name' => $ciudad->city->name
                    ];
                })->toArray(),
                'barrios' => $neighborhoods->map(function ($barrio) {
                    return [
                        'id' => $barrio->neighborhood->id,
                        'name' => $barrio->neighborhood->name
                    ];
                })->toArray(),
                'subzonas' => $subzones->map(function ($subzona) {
                    return [
                        'id' => $subzona->subzone->id,
                        'name' => $subzona->subzone->name
                    ];
                })->toArray()
            ];
        }

        if (!$this->provincesBusiness) {

            $this->provincias = Province::all();
        } else {

            $this->provincias = Province::whereIn('id', $this->provincesBusiness->pluck('province_id'))->get();

        }



        if ($this->selectedZones) {
            $provinciasKeep = [];

            foreach ($this->selectedZones as $zoneKeep) {
                $provinciasKeep[] = $zoneKeep['provincia']['id'];
            }

            $this->provincias = $this->provincias->whereNotIn('id', $provinciasKeep);
        }
    }

    public function toggleProvinciaSelection($provinciaId)
    {
        $this->selectedProvincia = ['id' => $provinciaId, 'name' => Province::find($provinciaId)->name];
        $this->ciudades = City::where('province_id', $provinciaId)->pluck('id', 'name')->toArray();
        $this->selectedCiudades = [];
        $this->barrios = [];
        $this->selectedBarrios = [];
        $this->subzonas = [];
        $this->selectedSubzonas = [];
    }

    public function toggleCiudadSelection($ciudadId, $ciudadNombre)
    {
        $foundKey = false;
        foreach ($this->selectedCiudades as $key => $value) {
            if ($value['id'] == $ciudadId) {
                $foundKey = $key;
                break;
            }
        }

        if ($foundKey !== false) {
            unset($this->selectedCiudades[$foundKey]);
        } else {
            $this->selectedCiudades[] = ['id' => $ciudadId, 'name' => $ciudadNombre];
        }

        $this->selectedCiudades = array_values($this->selectedCiudades);
        $selectedCiudadIds = array_column($this->selectedCiudades, 'id');
        $this->barrios = Neighborhood::whereIn('city_id', $selectedCiudadIds)->pluck('id', 'name')->toArray();
        $this->selectedBarrios = [];
        $this->subzonas = [];
        $this->selectedSubzonas = [];
    }

    public function toggleBarrioSelection($barrioId, $barrioNombre)
    {
        $foundKey = false;
        foreach ($this->selectedBarrios as $key => $value) {
            if ($value['id'] == $barrioId) {
                $foundKey = $key;
                break;
            }
        }

        if ($foundKey !== false) {
            unset($this->selectedBarrios[$foundKey]);
        } else {
            $this->selectedBarrios[] = ['id' => $barrioId, 'name' => $barrioNombre];
        }

        $this->selectedBarrios = array_values($this->selectedBarrios);
        $selectedBarrioIds = array_column($this->selectedBarrios, 'id');
        $this->subzonas = Subzone::whereIn('neighborhood_id', $selectedBarrioIds)->pluck('id', 'name')->toArray();
    }

    public function toggleSubzonaSelection($subzonaId, $subzonaNombre)
    {
        $foundKey = false;
        foreach ($this->selectedSubzonas as $key => $value) {
            if ($value['id'] == $subzonaId) {
                $foundKey = $key;
                break;
            }
        }

        if ($foundKey !== false) {
            unset($this->selectedSubzonas[$foundKey]);
        } else {
            $this->selectedSubzonas[] = ['id' => $subzonaId, 'name' => $subzonaNombre];
        }

        $this->selectedSubzonas = array_values($this->selectedSubzonas);
    }

    public function selectAllCiudades()
    {
        if (count($this->selectedCiudades) === count($this->ciudades)) {
            $this->selectedCiudades = [];
        } else {
            $this->selectedCiudades = array_map(function ($nombre, $id) {
                return ['id' => $id, 'name' => $nombre];
            }, array_keys($this->ciudades), $this->ciudades);
            $selectedCiudadIds = array_column($this->selectedCiudades, 'id');
            $this->barrios = Neighborhood::whereIn('city_id', $selectedCiudadIds)->pluck('id', 'name')->toArray();
        }
    }

    public function selectAllBarrios()
    {
        if (count($this->selectedBarrios) === count($this->barrios)) {
            $this->selectedBarrios = [];
        } else {
            $this->selectedBarrios = array_map(function ($nombre, $id) {
                return ['id' => $id, 'name' => $nombre];
            }, array_keys($this->barrios), $this->barrios);
            $selectedBarrioIds = array_column($this->selectedBarrios, 'id');
            $this->subzonas = Subzone::whereIn('neighborhood_id', $selectedBarrioIds)->pluck('id', 'name')->toArray();
        }
    }

    public function selectAllSubzonas()
    {
        if (count($this->selectedSubzonas) === count($this->subzonas)) {
            $this->selectedSubzonas = [];
        } else {
            $this->selectedSubzonas = array_map(function ($nombre, $id) {
                return ['id' => $id, 'name' => $nombre];
            }, array_keys($this->subzonas), $this->subzonas);
        }
    }

    public function addZone()
    {
        if (count($this->selectedZones) < 5) {
            if (count($this->selectedBarrios) > 0 && count($this->selectedCiudades) > 0 && $this->selectedProvincia != null) {
            
                $this->selectedZones[] = [
                    'provincia' => $this->selectedProvincia,
                    'ciudades' => $this->selectedCiudades,
                    'barrios' => $this->selectedBarrios,
                    'subzonas' => $this->selectedSubzonas
                ];

                $provinciasKeep = [];

                foreach ($this->selectedZones as $zoneKeep) {
                    $provinciasKeep[] = $zoneKeep['provincia']['id'];
                }

                if($this->provincesBusiness){
                    $this->provincias = Province::whereIn('id', $this->provincesBusiness->pluck('id'))->whereNotIn('id', $provinciasKeep)->get();
                } else {
                    $this->provincias = Province::whereNotIn('id', $provinciasKeep)->get();
                }


                // Creación de relaciones morfas utilizando las relaciones definidas en el modelo Business
                $this->model->countries()->create([
                    'country_id' => 1 // o el ID del país correspondiente
                ]);

                $this->model->provinces()->create([
                    'province_id' => $this->selectedProvincia['id']
                ]);

                foreach ($this->selectedCiudades as $ciudad) {
                    $this->model->cities()->create([
                        'city_id' => $ciudad['id']
                    ]);
                }

                foreach ($this->selectedBarrios as $barrio) {
                    $this->model->neighborhoods()->create([
                        'neighborhood_id' => $barrio['id']
                    ]);
                }

                foreach ($this->selectedSubzonas as $subzona) {
                    $this->model->subzones()->create([
                        'subzone_id' => $subzona['id']
                    ]);
                }

                $this->reset(['selectedProvincia', 'selectedCiudades', 'selectedBarrios', 'selectedSubzonas']);
            } else {
                // dd('hola');
                $this->dispatch('notification', ['message' => 'Debes seleccionar al menos una provincia, una ciudad, un barrio y una subzona', 'type' => Notifications::icons('error')]);
            }
        } else {
            $this->dispatch('notification', ['message' => 'No puedes seleccionar más de 5 zonas', 'type' => Notifications::icons('error')]);
        }
    }


    public function removeZone($index)
    {
        $provinciaId = $this->selectedZones[$index]['provincia']['id'];
        $ciudadesIds = array_column($this->selectedZones[$index]['ciudades'], 'id');
        $barriosIds = array_column($this->selectedZones[$index]['barrios'], 'id');
        $subzonasIds = array_column($this->selectedZones[$index]['subzonas'], 'id');

        $this->model->provinces()->where('province_id', $provinciaId)->delete();
        $this->model->cities()->whereIn('city_id', $ciudadesIds)->delete();
        $this->model->neighborhoods()->whereIn('neighborhood_id', $barriosIds)->delete();
        $this->model->subzones()->whereIn('subzone_id', $subzonasIds)->delete();

        unset($this->selectedZones[$index]);
        $this->selectedZones = array_values($this->selectedZones);

        if ($this->selectedZones) {
            $provinciasKeep = [];

            foreach ($this->selectedZones as $zoneKeep) {
                $provinciasKeep[] = $zoneKeep['provincia']['id'];
            }

            if($this->provincesBusiness){
                $this->provincias = Province::whereIn('id', $this->provincesBusiness->pluck('id'))->whereNotIn('id', $provinciasKeep)->get();
            } else {
                $this->provincias = Province::whereNotIn('id', $provinciasKeep)->get();
            }

        } else {
            if($this->provincesBusiness){
                $this->provincias = Province::whereIn('id', $this->provincesBusiness->pluck('id'))->get();
            } else {
                $this->provincias = Province::all();
            }
        }

        $this->dispatch('notification', ['message' => 'Zona eliminada', 'type' => Notifications::icons('error')]);
    }


    public function hasErrorAndForget($name)
    {
        $error = parent::hasErrorAndForget($name);

        if ($error) {
            $this->dispatch('notification', [
                'message' => $this->getErrorBag()->first(),
                'type' => Notifications::icons('error'),
            ]);
        }

        return $error;
    }

    public function render()
    {
        return view('livewire.components.select-zones');
    }
}
