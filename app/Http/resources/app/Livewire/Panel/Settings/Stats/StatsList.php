<?php

namespace App\Livewire\Panel\Settings\Stats;

use App\Models\Template;
use Livewire\Component;

class StatsList extends Component
{
    public function render()
    {
        
        return view('livewire.panel.settings.stats.stats-list',
            [
                'templates' => Template::where('business_id', auth()->user()->business_id)->paginate(10)
            ])->layout('layouts.panel');
    }
}
