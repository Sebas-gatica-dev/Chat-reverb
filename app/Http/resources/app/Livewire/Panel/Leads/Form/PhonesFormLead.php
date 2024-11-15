<?php

namespace App\Livewire\Panel\Leads\Form;

use App\Helpers\Notifications;
use App\Models\Phone;
use Livewire\Component;

class PhonesFormLead extends Component
{

    public $phones = [];
    public $number;
    public $tagNumber;
    public $typeNumber;
    public $phoneModel;
    public $data;


    public function mount()
    {
        $this->phones = array_map(function ($phone) {
            return [
                'id' => $phone['id'],
                'number' => $phone['number'],
                'tag' => $phone['tag'],
                'order' => $phone['order'],
                'type' => $phone['type'],
                'model' => $phone['phoneable_type'] === 'App\Models\Customer' ? 'customer' : 'property',
            ];
        }, $this->data['phones']);

        //ordenar por order
        
    }

    public function addPhone()
    {
        $this->authorize('access-function', 'property-add-phone');
        if (!authorizeFeatureCount('property-add-phone', $this->phones, $this)) {
            return;
        }

        $validated = $this->validate([
            'number' => 'required|numeric',
            'tagNumber' => 'required',
            'phoneModel' => 'required',
            'typeNumber' => 'required'
        ], $this->phoneMessages());


        $phoneDb = Phone::create([
            'number' => $this->number,
            'tag' => $this->tagNumber,
            'type' => $this->typeNumber,
            'phoneable_type' => $this->phoneModel == 'customer' ? 'App\Models\Customer' : 'App\Models\Property',
            'phoneable_id' => $this->phoneModel == 'customer' ? $this->data['customer_id'] : $this->data['property_id'],
            'order' => count($this->phones) + 1
        ]);

        $this->phones[] = [
            'id' => $phoneDb->id,
            'number' => $this->number,
            'tag' => $this->tagNumber,
            'type' => $this->typeNumber,
            'model' => $this->phoneModel
        ];



        $this->number = '';
        $this->tagNumber = '';
        $this->typeNumber = '';
        $this->phoneModel = '';


        $this->dispatch('notification', [
            'message' => 'Teléfono agregado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }


    public function updateTaskOrder($order)
    {

        $orderedPhones = [];


        foreach ($order as $item) {

            $orderedPhones[] = collect($this->phones)->firstWhere('id', $item['value']);
           $phone = Phone::where('id', $item['value'])->first();
            $phone->order = $item['order'];
            $phone->save();

            // $this->phones->a
        }

        $this->phones = $orderedPhones;

    }

    public function removePhone($id)
    {
        $this->phones = collect($this->phones)->reject(function ($phone) use ($id) {
            return $phone['id'] == $id;
        })->values()->toArray();

        $phoneDb = Phone::where('id', $id)->first();
        $phoneDb->delete();

        $this->dispatch('notification', [
            'message' => 'Teléfono eliminado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }



 protected function phoneMessages()
     {
         return [
             'number.required' => 'El número es obligatorio.',
             'number.numeric' => 'El número debe ser un valor numérico.',
             'tagNumber.required' => 'El tag del número es obligatorio.',
             'phoneModel.required' => 'El modelo del teléfono es obligatorio.',
             'typeNumber.required' => 'El tipo de número es obligatorio.',
         ];
     }

    public function render()
    {


        return view('livewire.panel.leads.form.phones-form-lead', [
            'phones' => $this->phones
        ]);
    }
}
