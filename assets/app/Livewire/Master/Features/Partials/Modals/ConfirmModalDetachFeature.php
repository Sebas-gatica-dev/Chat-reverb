<?php

namespace App\Livewire\Master\Features\Partials\Modals;

use App\Livewire\Master\Plans\EditPlan;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmModalDetachFeature extends Component
{
    public $show = false;
    public $name;
    public $maxWidth;

    public $title;

    public $type;


    public function mount($maxWidth = '2xl')
    {


        $this->maxWidth = [
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-md',
            'lg' => 'sm:max-w-lg',
            'xl' => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
        ][$maxWidth];
    }

    #[On('open-modal')]
    public function open($modal)
    {


        if ($modal['name'] == 'detachConfirm') {
            $this->show = true;
            $this->title = $modal['title'];
            $this->type = $modal['type'];
        }

    }

    #[On('close-modal')]
    public function close($modal)
    {
        if ($modal['name'] == 'detachConfirm') {
            $this->show = false;
            $this->reset(['title', 'type']);
        }
    }

    public function confirmDetach()
    {
        if($this->type == 'selectedOne'){
            $this->dispatch('detach-confirmed');
        }elseif($this->type == 'selectedMultiple'){
          $this->dispatch('detach-confirmed-multiple');
        }


    }

    public function cancelDetach()
    {
        if($this->type == 'selectedOne'){
            $this->dispatch('detach-cancelled');
        }elseif($this->type == 'selectedMultiple'){
            $this->dispatch('detach-cancelled-multiple');
        }


    }




    public function render()
    {
        return view('livewire.master.features.partials.modals.confirm-modal-detach-feature');
    }
}
