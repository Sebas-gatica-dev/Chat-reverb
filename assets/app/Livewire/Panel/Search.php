<?php

namespace App\Livewire\Panel;

use Livewire\Attributes\On;
use Livewire\Component;

class Search extends Component
{

    public $search;

    
    #[On('fill')] 
    public function fillSearch($search)
    {
        $this->search = $search;
    }

    public function searching()
    {
        return $this->redirectRoute('panel.search', ['search' => $this->search]);
    }


    public function render()
    {
        return view('livewire.panel.search');
    }
}
