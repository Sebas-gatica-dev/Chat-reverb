<?php

namespace App\Livewire\Panel\Settings\Stock;

use App\Helpers\Notifications;
use App\Models\Warehouse;
use Illuminate\Notifications\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Traits\ValidateNotificationTrait;

class EditWarehouse extends Component
{



    use ValidateNotificationTrait;

    public ?Warehouse $warehouse;

    #[Validate('required')]
    public $name;
    
    #[Validate('required')]
    public $address;
    public $latitude;
    public $longitude;

    public function mount()
    {

        // dd($this->warehouse);
        $this->name = $this->warehouse->name;
        $this->address = $this->warehouse->address;
        $this->dispatch('updateAddress', address: $this->address);

        $this->latitude = $this->warehouse->latitude;
        $this->longitude = $this->warehouse->longitude;
        

    }

    public function update()
    {
        $this->validate();

        $this->warehouse->update([
            'name' => $this->name,
            'address' => $this->address ?? 'Ubicacion personalizada',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);


        session()->flash('notification', [
            'message' => 'Sucursal actualizada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.settings.stock.warehouse.list', true, true);

    }


      //METODOS DE ACTUALIZACION DE LATITUD Y LONGITUD
      #[On('receive-start-lat')]
      public function updateStartLat($value){
          $this->latitude = $value;
       
      }
  
      #[On('receive-start-long')]
      public function updateStartLong($value){
          $this->longitude = $value;
        
      }


      #[On('receive-address')]
      public function receiveAddress($value){
          $this->address = $value;
      }
  
      #[On('updateAddress')]
      public function updateAddress($address)
      {
          $this->address = $address;
      }

    public function render()
    {
        return view('livewire.panel.settings.stock.edit-warehouse')->layout('layouts.panel');
    }
}