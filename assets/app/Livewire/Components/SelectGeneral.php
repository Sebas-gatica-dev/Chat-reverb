<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class SelectGeneral extends Component
{
    public $values;
    public $name;
    public $search;
    public $label;
    public $model;
    public $imageValue = null;
    public $searchEnabled = null;
    public $selectedValue = null;
    public function getListeners()
    {

        return [
            "update-values-{$this->name}" => 'updateValues',
            "clear-selected-value-{$this->name}" => 'selectValue',
        ];
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
            // Asignar el elemento seleccionado a selectedValue
            if ($this->selectedValue && $this->selectedValue['id'] == $id) {
                // Si el elemento ya está seleccionado, deseleccionarlo
                $this->selectedValue = null;
            } else {
                // Seleccionar el nuevo elemento
                $this->selectedValue = $selectedItem;
            }
        }


        // Enviar el valor seleccionado al frontend
        $this->dispatch(sprintf('update-selected-value-%s', $this->name), $this->selectedValue);
    }

    public function updatedSearch()
    {

        $this->dispatch(sprintf('update-search-%s', $this->name), $this->search);
    }

    public function updateValues($values)
    {

        $this->values = $values;
    }

    public function render()
    {
        return view('livewire.components.select-general');
    }
}
