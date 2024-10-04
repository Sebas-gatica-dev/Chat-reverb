<?php

namespace App\Livewire\Components\Maps;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GoogleMapFormFieldComponent extends Component
{
    public $latitude;
    public $longitude;
    // public $latitude = -34.59039;
    // public $longitude  = -58.41388;
    public $address= null;
    public $selectField = false;
    public $selectElements = [];
    public $coordSelect;
    public $preselect = false;
    public $input_id;
    public $inputField = false;




    // EL FORMATO QUE2 DEBERIA RECIBIR $selectElement DEBERIA SET UN ARRAY ASOCIATIVO CON UN FORMATO COMO ESTE

    // $this->branches = auth()->user()->business->branches()->get()->map(function ($branch) {
    //     return [
    //         'id' => $branch->id,
    //         'name' => $branch->name,
    //         'latitude' => $branch->latitude,
    //         'longitude' => $branch->longitude,
    //         'address' => $branch->address,
    //     ];
    // });


    public function mount()
    {
         
        if ($this->selectField) {
        
            if ($this->preselect) {
                $this->preselectBranch();
            }
        } else {
            // if($preselect){
            //     $this->dispatch('updateLatLong', ['lat' => $this->latitude, 'lng' => $this->longitude]);
            // }
            $this->dispatch('editPoint', ['status' => true]);
        }

   
      
        if(!$this->latitude || !$this->longitude){
            $this->dispatch('updateLatLong', lat: -34.59039, lng: -58.41388);
        }


    }



    private function preselectBranch()
    {
        foreach ($this->selectElements as $element) {

            if ($element['latitude'] == $this->latitude && $element['longitude'] == $this->longitude) {

            // dd('antes del error');
                $this->coordSelect = "{$element['latitude']},{$element['longitude']},{$element['address']}";
                $this->address = $element['address'];
                $this->dispatch('updateLatLong', lat: $this->latitude, lng: $this->longitude);
                $this->dispatch('updateAddress', address: $this->address);
                $this->dispatch('editPoint', status: false);
                break;
            }
        }
    }


    // public function updatedLatitude($value)
    // {
    //     dd($value);
    //     $this->dispatch('updateLatLong', lat: $value, lng: $this->longitude);
    // }


    // public function updatedLongitude($value)
    // {
    //     $this->dispatch('updateLatLong', lat: $this->latitude, lng: $value);
    // }


    #[On('updateLatLong')]
    public function updateLatLongFromMap($lat, $lng)
    {
        // $this->latitude = round($lat, 6);
        // $this->longitude = round($lng, 6);

        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->dispatch('receive-start-lat', $this->latitude);
        $this->dispatch('receive-start-long', $this->longitude);
    }

    #[On('updateAddress')]
    public function updateAddressFromMap($address)
    {
        $this->address = $address;
        $this->dispatch('receive-address', $this->address);
    }



    public function updatedAddress($value)
    {
        $this->dispatch('receive-address', $value);
    }






    #[On('updateAddress')]
    public function updateAddress($address)
    {
        $this->address = $address;
    }




    //METODO PARA ACTUALIZAR LAS COORDENADAS
    public function updatedCoordSelect($value)
    {
        // Verificar si el valor no es nulo o vacío
        if ($value == 'default') {


            $this->dispatch('updateLatLong', lat: -34.59039, lng: -58.41388);
            $this->dispatch('updateAddress', address: null);
            $this->dispatch('editPoint', status: false);
        } else if ($value != 'editPoint' && $value != 'default') {
            // Dividir las coordenadas y la dirección  

            [$lat, $long, $address] = explode(',', $value);


            // Enviar evento a JavaScript para actualizar el mapa
            $this->dispatch('updateLatLong', lat: $lat, lng: $long);
            $this->dispatch('updateAddress', address: $address);
            $this->dispatch('editPoint', status: false);
        } else {
            // Si el usuario deselecciona, resetear las coordenadas
            $this->latitude = -34.59039;
            $this->longitude = -58.41388;
            $this->address = '';

            // Enviar evento a JavaScript para actualizar el mapa
            $this->dispatch('editPoint', status: true);
            $this->dispatch('updateLatLong', lat: $this->latitude, lng: $this->longitude);
        }
    }

    public function render()
    {
        return view('livewire.components.maps.google-map-form-field-component');
    }
}
