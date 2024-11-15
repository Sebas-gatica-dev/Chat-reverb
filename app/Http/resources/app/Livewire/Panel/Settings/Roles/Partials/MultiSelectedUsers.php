<?php

namespace App\Livewire\Panel\Settings\Roles\Partials;

use App\Livewire\Panel\Settings\Roles\EditRole;
use App\Models\User;
use Livewire\Component;
use App\Models\Role;
use Livewire\Attributes\On;

class MultiSelectedUsers extends Component
{
    public $selectedUsers = [];

    public $users = [];

    public $role;
    public function mount()
    {
        $this->loadUsers();
    }


    #[On('refresh-users-for-rol')]
    public function loadUsers()
    {

        $this->users = User::where('business_id', auth()->user()->business_id)
            ->get()
            ->toArray();

            $this->selectedUsers = array_values($this->role->users->toArray());


    }

    public function selectAllUsers()
    {
        if (count($this->selectedUsers) === count($this->users)) {
            $this->selectedUsers = [];
        } else {
            $this->selectedUsers = $this->users;
        }
    }

    public function toggleUserSelected($userId)
    {
        $userKey = array_search($userId, array_column($this->selectedUsers, 'id'));

        if ($userKey !== false) {
            unset($this->selectedUsers[$userKey]);
        } else {
            $filteredUsers = array_filter($this->users, fn ($user) => $user['id'] == $userId);

            if (!empty($filteredUsers)) {
                $this->selectedUsers[] = reset($filteredUsers);
            }
        }

        $this->selectedUsers = array_values($this->selectedUsers);
    }


    public function addUsersToRole()
    {

        $this->dispatch('addUsersToRole', values: [
            'users' => $this->selectedUsers,
        ])->to(EditRole::class);

        $this->selectedUsers = [];
        $this->loadUsers();
    }

    public function render()
    {
        return view('livewire.panel.settings.roles.partials.multi-selected-users');
    }
}
