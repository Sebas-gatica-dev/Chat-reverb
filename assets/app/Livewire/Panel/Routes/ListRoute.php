<?php

namespace App\Livewire\Panel\Routes;

use App\Models\Visit;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListRoute extends Component
{

    use WithPagination;

    public $year;
    public $month;
    public $day;



    public function updateDate($date)
    {
        $date = \Carbon\Carbon::parse($date);
        $this->year = $date->year;
        $this->month = $date->month;
        $this->day = $date->day;



        $this->redirectRoute('panel.routes.daily', [
            'year' => $this->year,
            'month' => str_pad($this->month, 2, '0', STR_PAD_LEFT),
            'day' => str_pad($this->day, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }
    public function mount($year, $month, $day)
    {

        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }


    public function nextDay(){

        $date = \Carbon\Carbon::parse($this->year . '-' . $this->month . '-' . $this->day);
        $date = $date->addDay();
        $this->year = $date->year;
        $this->month = $date->month;
        $this->day = $date->day;



        $this->redirectRoute('panel.routes.daily', [
            'year' => $this->year,
            'month' => str_pad($this->month, 2, '0', STR_PAD_LEFT),
            'day' => str_pad($this->day, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }


    public function previousDay(){

        $date = \Carbon\Carbon::parse($this->year . '-' . $this->month . '-' . $this->day);
        $date = $date->subDay();
        $this->year = $date->year;
        $this->month = $date->month;
        $this->day = $date->day;

        $this->redirectRoute('panel.routes.daily', [
            'year' => $this->year,
            'month' => str_pad($this->month, 2, '0', STR_PAD_LEFT),
            'day' => str_pad($this->day, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }

    public function goToCalendar()
    {
        $this->redirectRoute('panel.routes.monthly', [
            'year' => $this->year,
            'month' => str_pad($this->month, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }


    public function render()
    {

        return view('livewire.panel.routes.list-route')->layout('layouts.panel', ['title' => 'Rutas']);
    }
}
