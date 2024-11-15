<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class MultiSelectGeneral extends Component
{

    public $values;
    public $name;
    public $search;
    public $label;
    public $model;
    public $imageValue = null;
    public $searchEnabled = null;
    public $selectedValues = [];
    public $selectAllActivated = true;
    public $selectAllBool = false;

    public $defaultOption = null;
    public $options; // Should be set when the component is initialized

    public $idComponent;



    // public function mount(){
    //     dd($this->selectedValues);
    // }
    public function getListeners()
    {

        return [
            "update-values-{$this->name}" => 'updateValues',
            "update-values-{$this->idComponent}-component-{$this->name}" => 'updateValues',
            "clear-selected-values-{$this->name}" => 'freshSelectedValues',
            "dispatch-selected-values-{$this->name}" => 'selectValue',
            "update-selectedIds-values-{$this->name}" => 'updateSelectedValues',
        ];
    }



    public function selectAllValues($values = [])
    {

        if (count($this->values) != count($this->selectedValues)) {
            $this->selectedValues = $values;
        } else {
            $this->selectedValues = [];
        }
        $this->dispatch(sprintf('update-selected-values-%s', $this->name), $this->selectedValues);
    }


    public function selectValue($id)
    {



        // Buscar el elemento en el array de items por su ID
        $selectedItem = null;
        foreach ($this->values as $item) {
            if ($item['id'] == $id) {
                $selectedItem = $item;

                break;
            }
        }



        if ($selectedItem !== null) {
            // Verificar si el elemento ya está en selectedValues
            $foundKey = null;
            foreach ($this->selectedValues as $key => $value) {
                if ($value['id'] == $id) {
                    $foundKey = $key;
                    break;
                }
            }

            if ($foundKey !== null) {
                // Si el elemento ya está en selectedValues, eliminarlo
                unset($this->selectedValues[$foundKey]);
                // Reindexar el array para evitar huecos en los índices
                $this->selectedValues = array_values($this->selectedValues);
            } else {
                // Si el elemento no está en selectedValues, añadirlo
                $this->selectedValues[] = $selectedItem;
            }
        }

        if ($this->idComponent) {
            $this->dispatch(sprintf('update-selected-values-%s', $this->idComponent), array_column($this->selectedValues, 'id') ?? null, $this->name);
        }


        $this->dispatch(sprintf('update-selected-values-%s', $this->name), $this->selectedValues);
    }

    //Lee los cambios que ocurren en la variable search
    public function updatedSearch()
    {
        if ($this->idComponent) {
            $this->dispatch(sprintf('update-search-%s', $this->idComponent .'-'. $this->name), $this->search);
        } else {

            $this->dispatch(sprintf('update-search-%s', $this->name), $this->search);
        }
    }



    public function freshSelectedValues()
    {

        $this->selectedValues = [];
    }


    public function updateValues($values)
    {


        $this->values = collect($values);


        if (count($this->selectedValues) != count($this->values)) {
            $this->selectAllBool = false;
        } else {
            $this->selectAllBool = true;
        }
    }


    public function updateSelectedValues($selectedIds)
    {

        // Mapear los IDs a los datos completos
        $this->selectedValues = $this->values->whereIn('id', $selectedIds)->values()->toArray();

        // Actualizar la propiedad 'values' si es necesario
        // $this->values = $this->options->values()->toArray(); // Aseguramos que 'values' contiene todas las opciones

        // Actualizar selectAllBool
        if (count($this->selectedValues) != count($this->values)) {
            $this->selectAllBool = false;
        } else {
            $this->selectAllBool = true;
        }
    }





    public function render()
    {
        return view('livewire.components.multi-select-general', [
            'values' => $this->values
        ]);
    }
}
