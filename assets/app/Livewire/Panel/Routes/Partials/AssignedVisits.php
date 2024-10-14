<?php

namespace App\Livewire\Panel\Routes\Partials;

use App\Models\Visit;
use Livewire\Component;
use Livewire\WithPagination;

class AssignedVisits extends Component
{



    use WithPagination;

    public $year;
    public $month;
    public $day;
    public $perPage = 10;



    public function render()
    {
        $assignedVisitsPaginated = Visit::where('business_id', auth()->user()->business_id)
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->whereDay('date', $this->day)
            ->whereHas('users')
            ->with(['users', 'property', 'customer.phones'])
            ->orderBy('time', 'asc')
            ->get();

        $assignedVisits = [];
        foreach ($assignedVisitsPaginated as $visit) {
            foreach ($visit->users as $user) {
                $assignedVisits[$user->id]['user'] = $user;
                $assignedVisits[$user->id]['visits'][] = $visit;
            }
        }

        return view('livewire.panel.routes.partials.assigned-visits', [
            'assignedVisits' => $assignedVisits,
            'assignedVisitsPaginated' => $assignedVisitsPaginated
        ]);
    }
}
