<?php

namespace App\Livewire\Panel\Settings\Branches;

use App\Helpers\Notifications;
use App\Models\Branch;
use Illuminate\Notifications\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Traits\ValidateNotificationTrait;


class EditBranch extends Component
{

    use ValidateNotificationTrait;

    public ?Branch $branch;

    #[Validate('required')]
    public $name;

    public $address;


    
    public $selectedBankAccounts = [];

    public $bank_accounts;

    public $selectedUsers = [];

    public $users;


    public $latitude;
    public $longitude;

    public function mount()
    {
        $this->name = $this->branch->name;
        $this->address = $this->branch->address;
        $this->dispatch('updateAddress', address: $this->address);

        $this->selectedUsers = $this->branch->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        })->toArray();

        // $this->users = $this->visit->property->branch->users;
        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });


        // dd($this->branch->bankAccounts);

        $this->selectedBankAccounts = $this->branch->bankAccounts()->get()->map(function ($bank_account) {
            return [
                'id' => $bank_account->id,
                'name' => $bank_account->holder,
            ];
        })->toArray();


        $this->bank_accounts = auth()->user()->business->bankAccounts()->get()->map(function ($bank_account) {
            return [
                'id' => $bank_account->id,
                'name' => $bank_account->holder,
            ];
        });



        $this->latitude = $this->branch->latitude;
        $this->longitude = $this->branch->longitude;
        


        //   dd( $this->latitude, $this->longitude);

    }


    #[On('update-selected-values-users')]
    public function updateSelectedUsers($value)
    {

        $this->selectedUsers = $value;
    }

    #[On('update-search-users')]
    public function searchUsers($search)
    {

        $this->users = auth()->user()->business->users()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
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






    public function update()
    {
        $this->validate();


        // dd($this->address ?? 'Ubicacion personalizada',$this->latitude, $this->longitude);

        $this->branch->update([
            'name' => $this->name,
            'address' => $this->address ?? 'Ubicacion personalizada',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->branch->users()->sync(array_column($this->selectedUsers, 'id'));
        $this->branch->bankAccounts()->sync(array_column($this->selectedBankAccounts, 'id'));

        session()->flash('notification', [
            'message' => 'Sucursal actualizada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.settings.branches.list', true, true);

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
        return view('livewire.panel.settings.branches.edit-branch')
            ->layout('layouts.panel');
    }




}
