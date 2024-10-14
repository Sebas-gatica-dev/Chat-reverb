<?php

namespace App\Livewire\Panel\Settings\Roles\Partials;

use App\Livewire\Panel\Settings\Roles\AddRole;
use App\Models\Role;
use Livewire\Component;

class SelectRole extends Component
{

    public $roles = [];
    public $selectedRole = null;
    public $searchTerm = '';

    public $type;

    public function mount()
    {
        $this->roles = Role::where('business_id', auth()->user()->business->id)->get()->toArray();
    }


    public function selectRole($roleId)
    {

        if ($roleId == (!empty($this->selectedRole->id) && $this->selectedRole->id)) {
            $this->reset('selectedRole');
            $this->dispatch('changeRole', value: null)->to(AddRole::class);

        } else {
            $this->selectedRole = Role::where('business_id', auth()->user()->business->id)->findOrFail($roleId);

            $this->dispatch('changeRole', value: $this->selectedRole->id)->to(AddRole::class);
        }
    }
    public function updatedSearchTerm()
    {
        if (strlen($this->searchTerm) > 1) {
            $this->roles = Role::where('name', 'like', '%' . $this->searchTerm . '%')->where('business_id', auth()->user()->business->id)->get()->toArray();
        } else {
            $this->roles = Role::where('business_id', auth()->user()->business->id)->get()->toArray();
        }
    }
    public function render()
    {
        return view('livewire.panel.settings.roles.partials.select-role');
    }
}
