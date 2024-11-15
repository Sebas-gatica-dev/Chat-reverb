<?php

namespace App\Livewire\Master\Businesses\Partials;

use App\Livewire\Master\Businesses\EditBusiness;
use App\Livewire\Panel\Settings\Roles\EditRole;
use App\Models\User;
use Livewire\Component;

class SelectUser extends Component
{
    public $users = [];
    public $selectedUser;
    public $searchTerm = '';

    public $type;

    public function mount()
    {
        if ($this->type == 'role') {
            $this->users = User::where('business_id', auth()->user()->business_id)->get()->toArray();
        } else {
            $this->users = User::all()->toArray(); // Convertimos la colección a un array
        }
    }


    public function selectUser($userId)
    {

        if ($userId == (!empty($this->selectedUser->id) && $this->selectedUser->id)) {
            $this->reset('selectedUser');


            if ($this->type == 'role') {
                $this->dispatch('changeUser', value: null)->to(EditRole::class);
            } else {
                $this->dispatch('changeUser', value: null)->to(EditBusiness::class);
            }
        } else {
            $this->selectedUser = User::findOrFail($userId);
            if ($this->type == 'role') {
                $this->dispatch('changeUser', value: $this->selectedUser->id)->to(EditRole::class);
            } else {
                $this->dispatch('changeUser', value: $this->selectedUser->id)->to(EditBusiness::class);
            }
        }
    }
    public function updatedSearchTerm()
    {
        if (strlen($this->searchTerm) > 1) {
            if($this->type == 'role'){
                $this->users = User::where('name', 'like', '%' . $this->searchTerm . '%')->where('business_id', auth()->user()->business_id)->get()->toArray();
            }else{
                $this->users = User::where('name', 'like', '%' . $this->searchTerm . '%')->get()->toArray();
            }
        } else {
            if($this->type == 'role'){
                $this->users = User::where('business_id', auth()->user()->business_id)->get()->toArray();
            }else{
            $this->users = User::all()->toArray(); // Reset users to all if search term is too short
            }
        }
    }


    public function render()
    {
        return view('livewire.master.businesses.partials.select-user');
    }
}
