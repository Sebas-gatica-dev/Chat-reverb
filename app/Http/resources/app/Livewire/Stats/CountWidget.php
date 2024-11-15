<?php

namespace App\Livewire\Stats;

use App\Models\Widget;
use Livewire\Component;
use Livewire\Attributes\On;
class CountWidget extends Component
{

    public $widgetId;
    public $title;
    public $total;
    public $color;
    public $size;
    public $widget;

    public function getListeners()
    {

        return [
            "refresh-widget-count-{$this->widgetId}" => 'refresh',
        ];
    }


    public function mount()
    {
        $this->widget = Widget::find($this->widgetId);

        $this->typeTotal();

    }


    public function typeTotal()
    {
        if ($this->widget->logic->value == 'sales') {
            $this->total = '$' . number_format($this->total, 0, ',', '.');
        }
    }
    



    public function refresh($widgetId,$title, $total, $color, $size)
    {

        $this->widgetId = $widgetId;
        $this->title = $title;
        $this->total = $total;
        $this->color = $color;
        $this->size = $size;
        $this->typeTotal();

    }

    public function render()
    {
        return view('livewire.stats.count-widget');
    }
}
