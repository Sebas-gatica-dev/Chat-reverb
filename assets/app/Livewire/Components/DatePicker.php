<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\On;

class DatePicker extends Component
{
    public $startDate;
    public $endDate;
    public $defaultRange = null; // Default range label
    public $rangeOptions = [];   // Array of range labels to include


    public function mount()
    {
        // Set default startDate and endDate based on defaultRange
        // Initialize to today as a fallback
        $this->startDate = Carbon::today()->format('d/m/Y');
        $this->endDate = Carbon::today()->format('d/m/Y');

        if ($this->defaultRange) {
            switch ($this->defaultRange) {
                case 'Último mes':
                    $this->startDate = Carbon::now()->subMonth()->startOfMonth()->format('d/m/Y');
                    $this->endDate = Carbon::now()->subMonth()->endOfMonth()->format('d/m/Y');
                    break;
                case 'Hoy':
                    // startDate and endDate already set to today
                    break;
                case 'Próximos 7 días':
                    $this->startDate = Carbon::today()->format('d/m/Y');
                    $this->endDate = Carbon::today()->addDays(6)->format('d/m/Y');
                    break;
                case 'Próximos 15 días':
                    $this->startDate = Carbon::today()->format('d/m/Y');
                    $this->endDate = Carbon::today()->addDays(14)->format('d/m/Y');
                    break;
                case 'Próximos 30 días':
                    $this->startDate = Carbon::today()->format('d/m/Y');
                    $this->endDate = Carbon::today()->addDays(29)->format('d/m/Y');
                    break;
                case 'Anteriores 7 días':
                    $this->startDate = Carbon::today()->subDays(7)->format('d/m/Y');
                    $this->endDate = Carbon::yesterday()->format('d/m/Y');
                    break;
                case 'Anteriores 15 días':
                    $this->startDate = Carbon::today()->subDays(15)->format('d/m/Y');
                    $this->endDate = Carbon::yesterday()->format('d/m/Y');
                    break;
                case 'Anteriores 30 días':
                    $this->startDate = Carbon::today()->subDays(30)->format('d/m/Y');
                    $this->endDate = Carbon::yesterday()->format('d/m/Y');
                    break;
                case 'Mes actual':
                    $this->startDate = Carbon::today()->startOfMonth()->format('d/m/Y');
                    $this->endDate = Carbon::today()->endOfMonth()->format('d/m/Y');
                    break;
                case 'Año actual':
                    $this->startDate = Carbon::today()->startOfYear()->format('d/m/Y');
                    $this->endDate = Carbon::today()->endOfYear()->format('d/m/Y');
                    break;
                default:
                    // If the defaultRange doesn't match any case, use today
                    break;
            }
        }

        if($this->defaultRange){
            $this->dateRangeSelected($this->startDate, $this->endDate);
        }
        // Emit the initial date range to the parent component
        // $this->dateRangeSelected($this->startDate, $this->endDate);
    }

    #[On('dateRange')]
    public function dateRangeSelected($start, $end)
    {
        // Convert dates from 'd/m/Y' to 'Y-m-d'
        $start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
        $end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');

        // Emit event so the parent component can receive the dates
        $this->dispatch('set-date-range', $start, $end);
    }

    public function render()
    {
        return view('livewire.components.date-picker');
    }
}
