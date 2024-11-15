<?php

namespace App\Livewire\Panel\Settings\Services;

use App\Helpers\Notifications;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListServices extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $name;
    public Service $editService;
    public $editName;


    public function mount(){
        $this->authorize('access-function','service-list');
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
           'name.required' => 'El servicio debe tener un nombre',
            'name.string' => 'El nombre del servicio debe ser un texto',
            'name.max' => 'El nombre no debe superar los 120 caracteres',
            'editName.required' => 'El servicio debe tener un nombre',
            'editName.string' => 'El nombre  del servicio debe ser un texto',
            'editName.max' => 'El nombre no debe superar los 120 caracteres'

        ];
    }


    public function createService()
    {
        $this->authorize('access-function','service-add');
        $this->validate();

        Service::create([
            'name' => $this->name,
            'business_id' => auth()->user()->business_id
        ]);

        $this->name = '';

        $this->dispatch('close-modal');
        $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Servicio creado']);

    }


    public function editModalService($id)
    {
        $this->editService = Service::find($id);

        if($this->editService){
            $this->editName = $this->editService->name;
            $this->dispatch('open-edit-modal');
        }
    }

    public function updateService()
    {

        $this->authorize('access-function','service-edit');

        $this->validate();

        if($this->editService){
            $this->editService->update([
                'name' => $this->editName
            ]);

            $this->editName = '';

            $this->dispatch('close-edit-modal');
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Servicio actualizado']);
        }
    }

    public function deleteService($id)
    {
        $this->authorize('access-function','service-soft');

        $service = Service::find($id);
        $service = Service::withTrashed()->find($id);
        $service_has_visits = $service->visits->count() > 0;

        if ($service && $service_has_visits) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar el servicio porque tiene visitas asociadas']);
        } else {
            $service->delete();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Servicio desactivado']);
        }
    }

    public function restoreService($id)
    {
        $this->authorize('access-function','service-restore');

        $service = Service::withTrashed()->find($id);
        if ($service->trashed()) {
            $service->restore();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Servicio restaurado']);
        }
    }



    public function forceDeleteService($id)
    {

        $this->authorize('access-function','service-delete');

        $service = Service::withTrashed()->find($id);
        $service_has_visits = $service->visits->count() > 0;

        if ($service && $service_has_visits) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede eliminar el servicio porque tiene visitas asociadas']);
        } else {
            $service->forceDelete();
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Servicio eliminado']);
        }
    }

    public function render()
    {
        return view('livewire.panel.settings.services.list-services',
            [
                'services' =>  auth()->user()->business->services()->withTrashed()->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(15)
            ])
            ->layout('layouts.panel');
    }
}
