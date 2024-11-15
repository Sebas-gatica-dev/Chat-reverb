<?php

namespace App\Livewire\Panel\Settings\Zones;

use App\Helpers\Notifications;
use App\Models\Business;
use App\Models\Subzonable;
use Livewire\Component;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Province;
use App\Models\Subzone;
use Illuminate\Support\Facades\Auth;

class ListZones extends Component
{

    public function mount(){
        $this->authorize('access-function','zone-list');
    }

    public function render()
    {
        return view('livewire.panel.settings.zones.list-zones')
            ->layout('layouts.panel');
    }
}
