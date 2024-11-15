<?php

namespace App\Livewire\Panel\Visit\VisitStatus;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Models\InputData;
use App\Models\Visit;
use App\Rules\FormDynamicRequired;
use Livewire\Attributes\On;
use Livewire\Component;

class Pending extends Component
{

    public Visit $visit;    
    public $formsDynamic = [];
    public $approximateTime;
    public $comment;
    public $current_latitude;
    public $current_longitude;



    public function mount($latitude, $longitude){
        $this->current_latitude = $latitude;
        $this->current_longitude = $longitude;
    }
    
    public function rules(){
         return [
            'formsDynamic.*' => [new FormDynamicRequired($this->formsDynamic)],
            'approximateTime' => 'required|numeric|min:1',
            'comment' => 'nullable|string|max:200'
         ]; 
    }


    public function messages(){
          return [
            'approximateTime.required' => 'Debes dar un aproximado de minutos que tardaras.',
            'approximateTime.numeric' => 'Este campo debe ser un número.',
            'approximateTime.min' => 'Este campo debe ser mayor a 0.',
            'comment.max' => 'El comentario no debe exceder los 200 caracteres.',
            'comment.string' => 'Este campo debe ser un texto.',
          ];        
    }


    #[On('update-status')]
    public function save(){

        $this->validate();


        // dd('no validaste');

        $dataJSON = json_encode([
            'approximate_time' => $this->approximateTime,
            'comment' => $this->comment,
        ]);

        $this->visit->status = StatusVisitEnum::ONTHEWAY;
        $this->visit->save();

        $newStatusChange =  $this->visit->statusChanges()->create([
            'visit_id' => $this->visit->id,
            'status' => StatusVisitEnum::ONTHEWAY,
            'latitude' => $this->current_latitude,
            'longitude' => $this->current_longitude,
            'interval_status' => 0,
            'data' => $dataJSON,
        ]);

        if ($this->formsDynamic) {
            foreach ($this->formsDynamic as $key => $form) {

                $data = [
                    'value' => $form['value'],
                ];

                $inputData = new InputData();
                $inputData->input_id = $key;
                $inputData->data = json_encode($data);
                $inputData->modeable_type = 'App\Models\StatusChange';
                $inputData->modeable_id = $newStatusChange->id;
                $inputData->user_id = auth()->id();
                $inputData->save();
            }
        }

        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "En camino".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id], true, true);
    }

    
    public function render()
    {
        return view('livewire.panel.visit.visit-status.pending')->layout('layouts.panel');
    }
}
