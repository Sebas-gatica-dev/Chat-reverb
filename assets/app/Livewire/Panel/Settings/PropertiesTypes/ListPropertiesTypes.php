<?php

namespace App\Livewire\Panel\Settings\PropertiesTypes;

use App\Helpers\Notifications;
use App\Models\PropertyType;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Traits\ValidateNotificationTrait;

class ListPropertiesTypes extends Component
{

    use WithPagination, WithoutUrlPagination, ValidateNotificationTrait;
    public $name;
    public PropertyType $editPropertyType;
    public $editName;


    public function mount()
    {
        $this->authorize('access-function', 'property-type-list');
    }

    public function rules()
    {
        return [
           'name' => 'required|string',
           'editName' => 'required|string'
           
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El tipo de propiedad debe tener un nombre',
            'name.string' => 'El nombre debe texto',
            'editName.required' => 'El tipo de propiedad debe tener un nombre',
            'editName.string' => 'El nombre debe ser texto',
        ];
    }



    

    public function createPropertyType()
    {
        $this->authorize('access-function', 'property-type-add');
        $this->validateOnly('name');

        PropertyType::create([
            'name' => $this->name,
            'business_id' => auth()->user()->business_id
        ]);

        $this->name = '';

        $this->dispatch('close-modal');
        $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de propiedad creado']);
    }


    public function editModalPropertyType($id)
    {
        $this->editPropertyType = PropertyType::find($id);

        if ($this->editPropertyType) {
            $this->editName = $this->editPropertyType->name;
            $this->dispatch('open-edit-modal');
        }
    }


    public function updatePropertyType()
    {
        $this->authorize('access-function', 'property-type-edit');
        $this->validateOnly('editName');

        if ($this->editPropertyType) {

            $this->editPropertyType->update([
                'name' => $this->editName
            ]);

            $this->editName = '';

            $this->dispatch('close-edit-modal');
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de propiedad actualizado']);
        }
    }

    public function deletePropertyType($id)
    {
        $this->authorize('access-function', 'property-type-soft');
        $propertyType = PropertyType::find($id);
        if ($propertyType && $propertyType->properties->count() > 0) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar el tipo de propiedad porque tiene propiedades asociadas']);
        } else {
            $propertyType->delete();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de propiedad desactivado']);
        }
    }

    public function restorePropertyType($id)
    {
        $this->authorize('access-function', 'property-type-restore');
        $propertyType = PropertyType::withTrashed()->find($id);
        if ($propertyType->trashed()) {
            $propertyType->restore();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de propiedad restaurado']);
        }
    }


    public function forceDeletePropertyType($id)
    {

        $propertyType = PropertyType::withTrashed()->find($id);

        if ($propertyType && $propertyType->properties->count() > 0) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede eliminar definitivamente el tipo de propiedad porque tiene propiedades asociadas']);
        } else {
            $propertyType->forceDelete();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de propiedad eliminado definitivamente']);
        }
    }

    public function render()
    {

        return view(
            'livewire.panel.settings.properties-types.list-properties-types',
            [
                'propertiesTypes' => PropertyType::withTrashed()->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(15)
            ]
        )
            ->layout('layouts.panel');
    }
}
