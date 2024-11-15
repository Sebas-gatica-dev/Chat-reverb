<?php

namespace App\Livewire\Panel\Settings\Branches;

use App\Helpers\Notifications;
use App\Models\Branch;
use App\Models\Province;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Traits\ValidateNotificationTrait;


class AddBranch extends Component
{
    use ValidateNotificationTrait;
    
    #[Validate('required|string|max:255')]
    public $name;
    public $address;

    public $bank_accounts;
    public $selectedBankAccounts = [];

    public $users;
    public $selectedUsers = [];
    public $latitude;
    public $longitude;


    public function mount()
    {

        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });

        $this->bank_accounts = auth()->user()->business->bankAccounts()->get()->map(function ($bank_account) {
            return [
                'id' => $bank_account->id,
                'name' => $bank_account->holder,
            ];
        });



    }


    public function render()
    {
        return view('livewire.panel.settings.branches.add-branch')
            ->layout('layouts.panel', ['title' => 'Crear sucursal']);
    }

    public function save($typeSave)
    {
        // Validate fields
        $this->validate();



        // dd($this->latitude, $this->longitude);
        // Create branch
        $branch = Branch::create([
            'business_id' => auth()->user()->business->id, // Obtener el id del negocio del usuario autenticado
            'name' => $this->name,
            'address' => $this->address ?? 'Ubicación personalizada',
            'created_by' => auth()->id(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);


        if($this->selectedUsers){
            $branch->users()->attach(array_column($this->selectedUsers, 'id'));
        }

        if($this->selectedBankAccounts){
            // dd('guarde bank accounts');
            $branch->bankAccounts()->attach(array_column($this->selectedBankAccounts, 'id'));
        }




        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Sucursal creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return $this->redirectRoute('panel.settings.branches.update', ['branch' => $branch->id], true, true);
        } elseif ($typeSave == 'save-new') {

            session()->flash('notification', [
                'message' => 'Sucursal creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return $this->redirectRoute('panel.settings.branches.create', true, true);
        } else {
            return $this->redirectRoute('panel.settings.branches.list', true, true);
        }
    }

    #[On('update-selected-values-users')]
    public function updateSelectedUsers($value)
    {

        $this->selectedUsers = $value;
    }

    #[On('update-search-users')]
    public function searchUsers($search)
    {

        $searchUsers = $search;

        $this->users = auth()->user()->business->users()
            ->when($searchUsers, function ($query) use ($searchUsers) {
                $query->where('name', 'like', '%' . $searchUsers . '%');
            })->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo,
                ];
            });

        $this->dispatch('update-values-users', $this->users);
    }


    #[On('update-selected-values-bank_accounts')]
    public function updateSelectedBankAccounts($value)
    {

        $this->selectedBankAccounts = $value;
    }

    #[On('update-search-bank_accounts')]
    public function searchBankAccounts($search)
    {

        $searchBankAccounts = $search;

        $this->bank_accounts = auth()->user()->business->bankAccounts()
            ->when($searchBankAccounts, function ($query) use ($searchBankAccounts) {
                $query->where('holder', 'like', '%' . $searchBankAccounts . '%');
            })->get()->map(function ($bank_account) {
                return [
                    'id' => $bank_account->id,
                    'name' => $bank_account->holder,
                ];
            });


        $this->dispatch('update-values-bank_accounts', $this->bank_accounts);
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




}
