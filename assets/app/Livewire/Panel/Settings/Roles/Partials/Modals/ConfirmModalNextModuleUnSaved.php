<?php

namespace App\Livewire\Panel\Settings\Roles\Partials\Modals;

use App\Livewire\Panel\Settings\Roles\Partials\MultiSelectedFeaturesRoles;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmModalNextModuleUnSaved extends Component
{


    public $open = false;
    public $name;

    public $title;

    public $description;

    public $module;




    public function mount()
    {

    }

    #[On('open-modal')]
    public function open($modal)
    {
            $this->open = true;
            $this->title = $modal['title'];
            $this->description = $modal['description'];
            $this->module = $modal['module'];


    }

    #[On('close-modal')]
    public function close($modal = null)
    {
            $this->open = false;
            $this->reset(['title', 'description', 'module']);

    }

    public function confirm()
    {

    $this->dispatch('next-confirmed-module', ['id' => $this->module ])->to(MultiSelectedFeaturesRoles::class);

    }

    public function cancel()
    {
        $this->open = false;
        $this->dispatch('cancel-confirmed-module')->to(MultiSelectedFeaturesRoles::class);



    }
    public function render()
    {
        return view('livewire.panel.settings.roles.partials.modals.confirm-modal-next-module-un-saved');
    }
}
