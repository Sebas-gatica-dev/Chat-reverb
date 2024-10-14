<?php

namespace App\Livewire\Stats;

use Livewire\Component;
use Livewire\Attributes\On;
class CountWidget extends Component
{

    public $widgetId;
    public $title;
    public $total;
    public $color;
    public $size;

    #[On('refreshCount')]
    public function mount($widgetId, $title, $total, $color, $size)
    {
        $this->widgetId = $widgetId;
        $this->title = $title;
        $this->total = $total;
        $this->color = $color;
        $this->size = $size;
    }

    public function render()
    {
        return view('livewire.stats.count-widget');
    }
}
