<?php

namespace App\Livewire\Master\Businesses;

use App\Models\Business;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddBusiness extends Component
{
    use WithFileUploads;

    public $name;
    public $logo;
    public $email;
    public $phone;
    public $address;
    public $user;


    public function mount()
    {

    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
        ];
    }



    public function save()
    {
        $this->validate();

        //Esta el logo seleccionado?
        $this->islogoSelected();

        $business = Business::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_by' => $this->user,
            'logo' => $this->logo
        ]);



        return redirect()->route('master.businesses.edit' , $business->id);

    }

    public function islogoSelected()
    {
        if ($this->logo) {
            $this->validate([
                'logo' => 'image|max:15000|required|unique:businesses', // 1MB Max
            ]);
            $this->logo = $this->logo->store(path: 'business/logos');
        }
    }


    #[On('changeUser')]
    public function changeUser($value)
    {
        $this->user = $value;

    }

    public function render()
    {
        return view('livewire.master.businesses.add-business')
        ->layout('layouts.master');
    }
}
