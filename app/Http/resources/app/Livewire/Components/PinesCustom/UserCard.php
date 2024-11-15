<?php

namespace App\Livewire\Components\PinesCustom;

use App\Helpers\Notifications;
use Livewire\Component;
use App\Models\Phone;


class UserCard extends Component
{

    public $user;
    public $phones = [];
    public $phoneForm;
    public $phoneNumberForm;
    public $phoneTagForm;
    public $phoneModelForm;
    public $phoneTypeForm;

    public function mount(){
        

    }



    public function addPhone()
    {
        $this->reset('phoneForm', 'phoneNumberForm', 'phoneTagForm', 'phoneModelForm', 'phoneTypeForm');
        $this->dispatch('open-phone-form');
    }


    
    public function editPhone($phoneId)
    {
        $this->authorize('access-function', 'phone-edit');
        $this->phoneForm = Phone::find($phoneId);
        $this->phoneNumberForm = $this->phoneForm->number;
        $this->phoneTagForm = $this->phoneForm->tag;

        if ($this->phoneForm->phoneable_type == 'App\Models\Customer') {
            $this->phoneModelForm = 'customer';
        } else {
            $this->phoneModelForm = 'property';
        }

        $this->phoneTypeForm = $this->phoneForm->type;

        $this->dispatch('open-phone-form');
    }

    public function deletePhone($phoneId)
    {
        $this->authorize('access-function', 'phone-delete');
        $phoneForm = Phone::find($phoneId);

        if ($phoneForm) {
            $phoneForm->delete();

            $this->dispatch('notification', [
                'message' => 'Teléfono eliminado correctamente',
                'type' => Notifications::icons('success')
            ]);
        }

        $this->reset('phoneForm');
    }

    public function orderPhone($order)
    {

        foreach ($order as $phone) {
            $phoneModel = Phone::find($phone['value']);
            $phoneModel->order = $phone['order'];
            $phoneModel->save();
        }
    }


    public function savePhone()
    {

        $this->authorize('access-function', 'phone-add');
        $this->validate([
            'phoneNumberForm' => 'required',
            'phoneTagForm' => 'required',
            'phoneModelForm' => 'required',
            'phoneTypeForm' => 'required',
        ]);

        if ($this->phoneForm) {
            $this->phoneForm->update([
                'number' => $this->phoneNumberForm,
                'tag' => $this->phoneTagForm,
                'type' => $this->phoneTypeForm,
            ]);

            if ($this->phoneModelForm == 'customer') {
                $this->phoneForm->phoneable_id = $this->customer->id;
                $this->phoneForm->phoneable_type = 'App\Models\Customer';
                $this->phoneForm->save();
            } else {
                $this->phoneForm->phoneable_id = $this->property->id;
                $this->phoneForm->phoneable_type = 'App\Models\Property';
                $this->phoneForm->save();
            }
        } else {


            $phones = array_merge($this->customer->phones->toArray(), $this->property->phones->toArray());


            if (!authorizeFeatureCount('phone-add', $phones, $this)) {
                $this->dispatch('close-phone-form');
                return;
            }

        

            Phone::create([
                'number' => $this->phoneNumberForm,
                'tag' => $this->phoneTagForm,
                'type' => $this->phoneTypeForm,
                'order' => $phones ? Arr::last($phones)['order'] + 1 : 1,
                'phoneable_id' => $this->phoneModelForm == 'customer' ? $this->customer->id : $this->property->id,
                'phoneable_type' => $this->phoneModelForm == 'customer' ? 'App\Models\Customer' : 'App\Models\Property',
            ]);



        }


        $this->customer->load('phones');
        $this->property->load('phones');
        $this->dispatch('close-phone-form');
        $this->reset('phoneForm');
    }





    public function render()
    {
        return view('livewire.components.pines-custom.user-card');
    }
}
