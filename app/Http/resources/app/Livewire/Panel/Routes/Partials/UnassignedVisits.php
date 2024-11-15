<?php

namespace App\Livewire\Panel\Routes\Partials;

use App\Models\Visit;
use Livewire\WithPagination;

use Livewire\Component;

class UnassignedVisits extends Component
{

    use WithPagination;

    public $year;
    public $month;
    public $day;
    public $perPage = 10;


    protected $paginationTheme = 'bootstrap'; // O cualquier otro tema que estés usando

    public function mount($year, $month, $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    

    public function render()
    {
        $unassignedVisitsPaginated = Visit::where('business_id', auth()->user()->business_id)
        ->where(function ($query) {
            $query->whereNull('date')
                  ->orWhereNull('time');
        })
        ->doesntHave('users')
        ->with(['property', 'customer.phones'])
        ->paginate($this->perPage, ['*'], 'unassignedPage');
    

        return view('livewire.panel.routes.partials.unassigned-visits', [
            'unassignedVisits' => $unassignedVisitsPaginated
        ]);
    }
}
