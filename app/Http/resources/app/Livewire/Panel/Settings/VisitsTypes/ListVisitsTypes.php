<?php

namespace App\Livewire\Panel\Settings\VisitsTypes;

use App\Helpers\Notifications;
use App\Models\VisitType;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Traits\ValidateNotificationTrait;


class ListVisitsTypes extends Component
{
    use WithPagination, WithoutUrlPagination, ValidateNotificationTrait;

    public $name;
    public VisitType $editVisitType;
    public $editName;




    public function mount() {
        $this->authorize('access-function','visit-type-list');
    }


    public function rules()
    {
        return [
           'name' => 'required|string|max:120',
           'editName' => 'required|string|max:120'
        ];
    }


    public function messages()
    {
        return [
           'name.required' => 'El tipo de visita debe tener un nombre',
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre no debe superar los 120 caracteres',
            'editName.required' => 'El tipo de visita debe tener un nombre',
            'editName.string' => 'El nombre debe ser un texto',
            'editName.max' => 'El nombre no debe superar los 120 caracteres'

        ];
    }

    public function createVisitType()
    {
        $this->authorize('access-function','visit-type-add');
        $this->validate();

        VisitType::create([
            'name' => $this->name,
            'business_id' => auth()->user()->business_id
        ]);

        $this->name = '';

        $this->dispatch('close-modal');
        $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de visita creado']);
    }


    public function editModalVisitType($id)
    {
        $this->editVisitType = VisitType::find($id);

        if ($this->editVisitType) {
            $this->editName = $this->editVisitType->name;
            $this->dispatch('open-edit-modal');
        }
    }

    public function updateVisitType()
    {
        $this->authorize('access-function','visit-type-edit');
        $this->validate();

        if($this->editVisitType) {
            $this->editVisitType->update([
                'name' => $this->editName
            ]);

            $this->editName = '';

            $this->dispatch('close-edit-modal');
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de visita actualizado']);
        }
    }

    public function deleteVisitType($id)
    {
        $this->authorize('access-function','visit-type-soft');
        $visitType = VisitType::find($id);
        if ($visitType && $visitType->visits->count() > 0) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar el tipo de visita porque tiene visitas asociadas']);
        } else {
            $visitType->delete();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de visita desactivado']);
        }
    }

    public function restoreVisitType($id)
    {
        $visitType = VisitType::withTrashed()->find($id);
        if ($visitType->trashed()) {
            $visitType->restore();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Tipo de visita restaurado']);
        }
    }



    public function forceDeleteVisitType($id)
    {

        $this->authorize('access-function','visit-type-delete');
        $visitType = VisitType::withTrashed()->find($id);

        if ($visitType && $visitType->visits->count() > 0) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede eliminar el tipo de visita porque tiene visitas asociadas']);
        } else {
            $visitType->forceDelete();
            $this->dispatch('notification', ['type' => Notifications::icons('sucess'), 'message' => 'Tipo de visita eliminado definitivamente']);
        }
    }

    public function render()
    {
        return view(
            'livewire.panel.settings.visits-types.list-visits-types',
            [
                'visitsTypes' => VisitType::withTrashed()->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(15)
            ]
        )
            ->layout('layouts.panel');
    }
}
