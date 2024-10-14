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




    // public function mount(){
    //     dd($this->selectedValues);
    // }
    public function getListeners()
    {

        return [
            "update-values-{$this->name}" => 'updateValues',
            "clear-selected-values-{$this->name}" => 'freshSelectedValues',
            "dispatch-selected-values-{$this->name}" => 'selectValue',
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


      

        $this->dispatch(sprintf('update-selected-values-%s', $this->name), $this->selectedValues);

    }

    //Lee los cambios que ocurren en la variable search
    public function updatedSearch()
    {
        $this->dispatch(sprintf('update-search-%s', $this->name), $this->search);
    }


    public function freshSelectedValues()
    {
        $this->selectedValues = [];
    }


    public function updateValues($values)
    {

        $this->values = collect($values);

        if(count($this->selectedValues) != count($this->values)) {
            $this->selectAllBool = false;
        }else{
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
