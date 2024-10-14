<?php

namespace App\Livewire\Master\Businesses;

use App\Livewire\Master\Features\Partials\MultiSelectFeatures;
use App\Models\Business;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditBusiness extends Component
{
    use WithFileUploads;

    public ?Business $business;
    public $name;
    public $logoPreview;
    public $logo;
    public $email;
    public $phone;
    public $address;

    public $user;
    public $selectedFeatures = [];
    public $selectAll = false;

    public function mount()
    {

        $this->name = $this->business->name;
        $this->logoPreview = $this->business->logo;
        $this->email = $this->business->email;
        $this->phone = $this->business->phone;
        $this->address = $this->business->address;
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



    public function update()
    {
        $this->validate();

        //Esta el logo seleccionado?
        $this->islogoSelected();

        $this->business->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_by' => $this->user,
        ]);



        return $this->redirectRoute('master.businesses.index');
    }

    public function islogoSelected()
    {
        if ($this->logo) {
            $this->validate([
                'logo' => 'image|max:15000|required|unique:businesses', // 1MB Max
            ]);
            $path = $this->logo->store(path: 'business/logos');
            $this->business->update(['logo' => $path]);
        }
    }

    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|max:15000|required|unique:businesses', // 1MB Max
        ]);

        if ($this->logo) {
            $this->logoPreview = $this->logo->temporaryUrl();
        }
    }

    public function updatedSelectAll($value)
    {

        if ($value) {
            $this->selectedFeatures = $this->business->features()->pluck('id')->toArray();
        } else {
            $this->selectedFeatures = [];
        }
    }

    #[On('changeUser')]
    public function changeUser($value)
    {
        $this->user = $value;

    }

    #[On('addFeaturesToBusiness')]
    public function associateFeaturesToBusiness($values)
    {

        // Lógica para asociar las funciones seleccionadas al negocio
        $featureIds = array_column($values['features'], 'id');

        $this->business->features()->attach($featureIds);

        $this->dispatch('refresh-features-for-business')->to(MultiSelectFeatures::class);




    }

    public function confirmDetachFeature($idFeature){

        $this->business->features()->detach($idFeature);
        $this->dispatch('refresh-features-for-business')->to(MultiSelectFeatures::class);




    }

    public function confirmDetachSelectedFeaturesForBusiness(){

        $this->business->features()->detach($this->selectedFeatures);
        $this->dispatch('refresh-features-for-business')->to(MultiSelectFeatures::class);
        $this->selectAll = false;
        $this->selectedFeatures = [];

    }

    public function render()
    {
        return view('livewire.master.businesses.edit-business', [
            'features' => $this->business->features()->paginate(6)
        ])
            ->layout('layouts.master');
    }
}
