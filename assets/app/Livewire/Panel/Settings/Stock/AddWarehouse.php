<?php

namespace App\Livewire\Panel\Settings\Stock;

use App\Helpers\Notifications;
use App\Models\Warehouse;
use App\Models\Province;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Traits\ValidateNotificationTrait;

class AddWarehouse extends Component
{


    use ValidateNotificationTrait;
    
    #[Validate('required|string|max:255')]
    public $name;
    public $address;
    public $latitude;
    public $longitude;
    public $users;


    public function mount()
    {

        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });

     
    }

    public function save($typeSave)
    {
        // Validate fields
        $this->validate();


        // dd($this->latitude, $this->longitude);
        // Create branch
        $branch = Warehouse::create([
            'business_id' => auth()->user()->business->id, // Obtener el id del negocio del usuario autenticado
            'name' => $this->name,
            'address' => $this->address ?? 'Ubicación personalizada',
            'created_by' => auth()->id(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);


        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Sucursal creado correctamente',
                'type' => Notifications::icons('success')
            ]);




            return $this->redirectRoute('panel.settings.stock.warehouse.list', true, true);
        } elseif ($typeSave == 'save-new') {

            session()->flash('notification', [
                'message' => 'Sucursal creado correctamente',
                'type' => Notifications::icons('success')
            ]);
            return $this->redirectRoute('panel.settings.stock.warehouse.create', true, true);
        }
    }

  

    //METODOS DE ACTUALIZACION DE LATITUD Y LONGITUD
    #[On('receive-start-lat')]
    public function updateLatitude($value){
        $this->latitude = $value;
     
    }

    #[On('receive-start-long')]
    public function updateLongitude($value){
        $this->longitude = $value;
      
    }


    #[On('updateAddress')]
    public function updateAddress($address)
    {
        $this->address = $address;
    }



    public function render()
    {
        return view('livewire.panel.settings.stock.add-warehouse')->layout('layouts.panel',[
            ['title' => 'Registrar deposito']
        ]);
    }
}
