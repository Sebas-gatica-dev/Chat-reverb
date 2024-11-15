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
    public $live = false;
    public $model;
    public $setAllFieldsForItem = false;
    public $imageValue = null;
    public $searchEnabled = null;
    public $selectedValue = null;
    public $defaultOption = null;
    public $idComponent;



    public function getListeners()
    {

        return [
            "update-values-{$this->name}" => 'updateValues',
            "update-values-{$this->idComponent}-component-{$this->name}" => 'updateValues',
            "clear-selected-value-{$this->name}" => 'selectValue',
            "change-selected-value-{$this->name}" => 'changeValue'
        ];
    }
    public function selectValue($id)
    {
        $selectedItem = null;

        if ($id == null) {
            $this->selectedValue = null;
        } else {


            // Buscar el elemento en el array de items por su ID

            foreach ($this->values as $item) {
                if ($item['id'] == $id) {
                    if (count($item) > 2) {
                        $selectedItem = $item;
                    } else {
                        $selectedItem = $item['id'];
                    }
                    break;
                }
            }
        }


        if ($selectedItem !== null) {
            // Asignar el elemento seleccionado a selectedValue
            if ($this->selectedValue && (($this->selectedValue == $id) || (is_array($this->selectedValue) ? $this->selectedValue['id'] == $id : false))) {
                // Si el elemento ya está seleccionado, deseleccionarlo
                $this->selectedValue = null;
            } else {
                // Seleccionar el nuevo elemento
                $this->selectedValue = $selectedItem;
            }
        }





        if ($this->live) {


            $this->dispatch(sprintf('update-selected-value-live-%s', $this->idComponent), $this->selectedValue ?? null, $this->name);

            if ($id != null) {
                usleep(700000);
                $this->dispatch('selectValueFinished');
            }
        } else {
            $this->dispatch(sprintf('update-selected-value-%s', $this->name), $this->selectedValue);
        }
    }

    public function updatedSearch()
    {

        if ($this->idComponent) {
            $this->dispatch(sprintf('update-search-%s', $this->idComponent . '-' . $this->name), $this->search);
        } else {
            $this->dispatch(sprintf('update-search-%s', $this->name), $this->search);
        }
    }

    public function updateValues($values)
    {
        $this->values = array_values($values);
    }




    // con esto directamente cambiamos el valor seleccionado, y no nos fijamos si es que existe y lo deseleccionamos
    public function changeValue($id)
    {
        $selectedItem = null;

        if ($id == null) {
            $this->selectedValue = null;
        } else {

            foreach ($this->values as $item) {
                if ($item['id'] == $id) {
                    if (count($item) > 2) {
                        $selectedItem = $item;
                    } else {
                        $selectedItem = $item['id'];
                    }
                    break;
                }
            }

            $this->selectedValue = $selectedItem;
        }


        if ($this->live) {

            $this->dispatch(sprintf('update-selected-value-live-%s', $this->idComponent), $this->selectedValue ?? null, $this->name);

            if ($id != null) {
                $this->dispatch('selectValueFinished');
            }
        } else {
            $this->dispatch(sprintf('update-selected-value-%s', $this->name), $this->selectedValue);
        }
    }

    public function render()
    {
        return view('livewire.components.select-general');
    }
}
