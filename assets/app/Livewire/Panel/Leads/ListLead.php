<?php

namespace App\Livewire\Panel\Leads;

use App\Enums\SourcesEnum;
use App\Enums\StatusLedEnum;
use App\Models\Lead;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ListLead extends Component
{
    use WithPagination;

    public $zones;
    public $users;
    public $statuses;
    public $propertyTypes;
    public $sources;
    #[Url(as: 'desde')]
    public $selectedDateStart;
    #[Url(as: 'hasta')]
    public $selectedDateEnd;
    public $countFilters = 0;
    #[Url(as: 'zona')]
    public $selectedZone;
    #[Url(as: 'operario')]
    public $selectedUser;
    #[Url(as: 'estado')]
    public $selectedStatus;
    #[Url(as: 'tipo-fuente')]
    public $selectedSource;
    #[Url(as: 'tipo-propiedad')]
    public $selectedPropertyType;
    public $sort = 'newest';

    public $searchZone;

    public $business;

    #[Url(as: 'buscar')]
    public $searchTerm = '';

    public function mount()
    {
        $this->business = auth()->user()->business;

        // Initialize filter options
       $this->changeZones();




        $this->users = User::where('business_id', $this->business->id)->get()->map(function ($user) {
            return ['id' => $user->id, 'name' => $user->name];
        });
        $this->statuses = collect(StatusLedEnum::cases())->map(function ($status) {
            return ['id' => $status->value, 'name' => $status->value];
        });
        $this->propertyTypes = PropertyType::where('business_id', $this->business->id)->get()->map(function ($type) {
            return ['id' => $type->id, 'name' => $type->name];
        });
        $this->sources = collect(SourcesEnum::cases())->map(function ($source) {
            return ['id' => $source->value, 'name' => $source->value];
        });
        // Initialize filters
        $this->selectedDateStart = null;
        $this->selectedDateEnd = null;
    }




    #[Computed]
    public function leads()
    {
        $query = Lead::select('id', 'name', 'surname', 'date', 'time', 'phone', 'type_contact', 'status', 'service_id', 'neighborhood_id', 'city_id')->with([
            'service' => function ($query) {
                $query->select('id', 'name');
            },
            'neighborhood' => function ($query) {
                $query->select('id', 'name');
            },
            'city' => function ($query) {
                $query->select('id', 'name');
            },'budget' ])->where('business_id', auth()->user()->business_id);




        // Apply filters
        $query = $this->applyFilters($query);


        // Apply search
        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('surname', 'like', $searchTerm)
                    ->orWhere('phone', 'like', $searchTerm)
                    ->orWhereHas('service', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('neighborhood', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('city', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    });
            });
        }



        // Apply sorting
        $query->orderBy('created_at', $this->sort === 'newest' ? 'desc' : 'asc');


        return $query->paginate(10);
    }


    protected function applyFilters($query)
    {
        // Filter by zone
        $query->when($this->selectedZone, function ($query) {
            $selectedZone = $this->selectedZone;
            $model = $selectedZone['model'];
            $id = $selectedZone['id'];

            $query->where(function ($query) use ($model, $id) {
                if ($model === 'Provincia') {
                    $query->where('province_id', $id);
                } elseif ($model === 'Ciudad') {
                    $query->where('city_id', $id);
                } elseif ($model === 'Barrio') {

                    $query->where('neighborhood_id', $id);
                } elseif ($model === 'Subzona') {

                    $query->where('subzone_id', $id);
                }
            });
        })->when($this->selectedDateStart && $this->selectedDateEnd, function ($query) {

            $start = Carbon::parse($this->selectedDateStart)->startOfDay();
            $end = Carbon::parse($this->selectedDateEnd)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        })->when($this->selectedUser, function ($query) {

            $query->where('created_by', $this->selectedUser['id']);
        })->when($this->selectedStatus, function ($query) {

            $query->where('status', $this->selectedStatus['id']);
        })->when($this->selectedPropertyType, function ($query) {

            $query->whereHas('properties', function ($query) {

                $query->where('property_type', $this->selectedPropertyType['id']);
            });
        })->when($this->selectedSource, function ($query) {

            $query->where('source', $this->selectedSource['id']);
        });





        return $query;
    }



    // Update count of applied filters
    public function updateCountFilters()
    {
        $this->countFilters = 0;

        if ($this->selectedZone) $this->countFilters++;
        if ($this->selectedDateStart && $this->selectedDateEnd) $this->countFilters++;
        if ($this->selectedUser) $this->countFilters++;
        if ($this->selectedStatus) $this->countFilters++;
        if ($this->selectedPropertyType) $this->countFilters++;
        if ($this->selectedSource) $this->countFilters++;
        if ($this->searchTerm) $this->countFilters++;
    }

    // Event listeners for SelectGeneral component
    #[On('update-selected-value-zones')]
    public function updateSelectedZone($value)
    {
        $this->selectedZone = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-users')]
    public function updateSelectedUser($value)
    {
        $this->selectedUser = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-statuses')]
    public function updateSelectedStatus($value)
    {
        $this->selectedStatus = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-propertyTypes')]
    public function updateSelectedPropertyType($value)
    {
        $this->selectedPropertyType = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-sources')]
    public function updateSelectedSource($value)
    {
        $this->selectedSource = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }


    #[On('update-search-zones')]
    public function updateSearchZone($search)
    {

        $this->searchZone = $search;

        $this->changeZones();
        $this->resetPage();
    }


    public function changeZones()
    {
        $provincias = $this->business->provinces()->with('province', fn($query) => $query->select(['id', 'name']))
            ->when($this->searchZone, function ($query) {
                $query->whereHas('province', function ($query) {
                    $query->where('name', 'like', '%' . $this->searchZone . '%');
                });
            })
            ->limit(3)
            ->get()
            ->map(function ($province) {
                return [
                    'id' => $province->province->id,
                    'name' => $province->province->name,
                    'model' => 'Provincia',
                ];
            });

        $ciudades = $this->business->cities()->with('city', fn($query) => $query->select(['id', 'name']))
            ->when($this->searchZone, function ($query) {
                $query->whereHas('city', function ($query) {
                    $query->where('name', 'like', '%' . $this->searchZone . '%');
                });
            })
            ->limit(3)
            ->get()
            ->map(function ($city) {
                return [
                    'id' => $city->city->id,
                    'name' => $city->city->name,
                    'model' => 'Ciudad',
                ];
            });

        $barrios = $this->business->neighborhoods()->with('neighborhood', fn($query) => $query->select(['id', 'name']))
            ->when($this->searchZone, function ($query) {
                $query->whereHas('neighborhood', function ($query) {
                    $query->where('name', 'like', '%' . $this->searchZone . '%');
                });
            })
            ->limit(3)
            ->get()
            ->map(function ($neighborhood) {
                return [
                    'id' => $neighborhood->neighborhood->id,
                    'name' => $neighborhood->neighborhood->name,
                    'model' => 'Barrio',
                ];
            });

        $subzonas = $this->business->subzones()->with('subzone', fn($query) => $query->select(['id', 'name']))
            ->when($this->searchZone, function ($query) {
                $query->whereHas('subzone', function ($query) {
                    $query->where('name', 'like', '%' . $this->searchZone . '%');
                });
            })
            ->limit(3)
            ->get()
            ->map(function ($subzone) {
                return [
                    'id' => $subzone->subzone->id,
                    'name' => $subzone->subzone->name,
                    'model' => 'Subzona',
                ];
            });

        $this->zones = collect($provincias)->merge($ciudades)->merge($barrios)->merge($subzonas);

        $this->dispatch('update-values-zones', $this->zones);
    }



    #[On('set-date-range')]
    public function setDateRange($startDate, $endDate)
    {
        $this->selectedDateStart = $startDate;
        $this->selectedDateEnd = $endDate;
        $this->updateCountFilters();
        $this->resetPage();
    }



    public function resetFilters()
    {
        $this->selectedZone = null;
        $this->selectedDateStart = null;
        $this->selectedDateEnd = null;
        $this->selectedUser = null;
        $this->selectedStatus = null;
        $this->selectedPropertyType = null;
        $this->selectedSource = null;
        $this->updateCountFilters();
        $this->resetPage();
    }




    public function updateSort($sort)
    {
        $this->sort = $sort;
        $this->resetPage();
    }


    public function render()
    {
        return view('livewire.panel.leads.list-lead')
            ->layout('layouts.panel', ['title' => 'Leads']);
    }
}
