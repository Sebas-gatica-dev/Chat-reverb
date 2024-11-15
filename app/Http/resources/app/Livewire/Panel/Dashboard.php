<?php

namespace App\Livewire\Panel;

use App\Enums\WidgetLogicEnum;
use App\Livewire\Stats\CountWidget;
use App\Models\Template;
use App\Models\Widget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public $data = [];
    public $pickerStartDate;
    public $pickerEndDate;
    public $pickerRange;
    public $template;

    public function mount()
    {
        $this->template = Auth::user()->templates->first() ? Auth::user()->templates->first() : Auth::user()->roles->first()->templates->first();
        //                                                                              Auth::user()->roles->first()->templates->first()


        // foreach ($this->template->widgets as $widget) {
        //     $this->processWidgetLogic($widget);
        // }
    }

    #[On('set-date-range')]
    public function dateRangeSelected($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
    
        // Calcular la diferencia en días
        $differenceInDays = $start->diffInDays($end);
    
        // Verificar si la diferencia es mayor a 60 días
        if ($differenceInDays > 60) {
            // Si es mayor a 60 días, usar el formato Y-M
            $this->pickerStartDate = $start->format('Y-m-d');
            $this->pickerEndDate = $end->format('Y-m-d');
            $this->pickerRange = 'month';

        } else {
            // Si es menor o igual a 60 días, mantener el formato original
            $this->pickerStartDate = $startDate;
            $this->pickerEndDate = $endDate;
            $this->pickerRange = 'days';
        }


        $this->dispatch('refresh-widgets', $this->pickerStartDate, $this->pickerEndDate, $this->pickerRange);
    }
   

    


    public function render()
    {
        return view('livewire.panel.dashboard', ['template' => Auth::user()->templates->first()])
            ->layout('layouts.panel');
    }
}
