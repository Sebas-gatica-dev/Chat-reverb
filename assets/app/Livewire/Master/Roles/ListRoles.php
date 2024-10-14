<?php

namespace App\Livewire\Master\Roles;

use App\Models\Role;
use Livewire\Component;

class ListRoles extends Component
{

    public $roles;

    public function mount()
    {
        $this->roles = Role::all();
       // $this->roles = Role::where('business_id', null)->get();
    }
    public function render()
    {
        return view('livewire.master.roles.list-roles')
            ->layout('layouts.master');
    }
}
