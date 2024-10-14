<?php

namespace App\Livewire\Panel\Routes;

use Carbon\Carbon;
use Livewire\Component;

class CalendarMonthVisit extends Component
{
    public $currentMonth;
    public $currentYear;
    public $startOfWeek;
    public $endOfWeek;

    public $currentDay;
    public $events = [];

    public function mount($year = null, $month = null)
    {
        $this->currentMonth = $month ?? Carbon::now()->month;
        $this->currentYear = $year ?? Carbon::now()->year;
        $this->currentDay = Carbon::now()->day;

        $this->calculateCalendarDates();

        // $this->loadEvents();
    }

    public function calculateCalendarDates()
    {
        $firstDayOfMonth = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $this->startOfWeek = $firstDayOfMonth->copy()->startOfWeek();
        $this->endOfWeek = $firstDayOfMonth->copy()->endOfMonth()->endOfWeek();
    }

    // public function loadEvents()
    // {
    //     // Cargar eventos desde la base de datos o cualquier otra fuente
    //     $this->events = [
    //         '2024-01-03' => [
    //             ['time' => '10AM', 'title' => 'Design review'],
    //             ['time' => '2PM', 'title' => 'Sales meeting'],
    //         ],
    //         '2024-01-07' => [
    //             ['time' => '6PM', 'title' => 'Date night'],
    //         ],
    //         '2024-01-12' => [
    //             ['time' => '2PM', 'title' => 'Sam\'s birthday party'],
    //         ],
    //         // Agregar más eventos según sea necesario
    //     ];
    // }

    // public function previousMonth()
    // {
    //     $currentDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
    //     $this->currentMonth = $currentDate->month;
    //     $this->currentYear = $currentDate->year;
    //     $this->calculateCalendarDates();
    //     $this->loadEvents();
    // }

    // public function nextMonth()
    // {
    //     $currentDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
    //     $this->currentMonth = $currentDate->month;
    //     $this->currentYear = $currentDate->year;
    //     $this->calculateCalendarDates();
    //     $this->loadEvents();
    // }


    public function previousMonth()
    {
        $currentDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $currentDate->month;
        $this->currentYear = $currentDate->year;
        $this->calculateCalendarDates();
        // $this->loadEvents();
        $this->redirectRoute('panel.routes.monthly', [
            'year' => $this->currentYear,
            'month' => str_pad($this->currentMonth, 2, '0', STR_PAD_LEFT)
        ]);
    }

    public function nextMonth()
    {
        $currentDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $currentDate->month;
        $this->currentYear = $currentDate->year;
        $this->calculateCalendarDates();
        // $this->loadEvents();
        $this->redirectRoute('panel.routes.monthly', [
            'year' => $this->currentYear,
            'month' => str_pad($this->currentMonth, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }
    public function goToDay($date)
    {
        $date = Carbon::parse($date);
        $this->redirectRoute('panel.routes.daily', [
            'year' => $date->year,
            'month' => str_pad($date->month, 2, '0', STR_PAD_LEFT),
            'day' => str_pad($date->day, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }



    public function goToMonth($date)
    {
        $date = Carbon::parse($date);
        $this->redirectRoute('panel.routes.monthly', [
            'year' => $date->year,
            'month' => str_pad($date->month, 2, '0', STR_PAD_LEFT)
        ], true, true);
    }

    public function render()
    {
        return view('livewire.panel.routes.calendar-month-visit')
            ->layout('layouts.panel');
    }
}
