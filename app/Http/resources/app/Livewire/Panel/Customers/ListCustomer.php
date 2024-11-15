<?php

namespace App\Livewire\Panel\Customers;

use App\Enums\FrequencyEnum;
use App\Enums\StatusCustomerEnum;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Enums\StatusVisitEnum;
use App\Models\Business;
use MercadoPago\Resources\User\Status;

class ListCustomer extends Component
{
    use WithPagination;

    public $zones = [];
    public $propertyTypes = [];
    public $frequencies = [];
    public $branches = [];

    public $branchesIds;

    #[Url(as: 'zona')]
    public $selectedZone;
    #[Url(as: 'tipo-propiedad')]
    public $selectedPropertyType;
    #[Url(as: 'frecuencia')]
    public $selectedFrequency;
    #[Url(as: 'sucursal')]
    public $selectedBranch;
    public $searchZone;
    public $business;
    public $sort = 'newest';
    public $countFilters = 0;
    public function mount()
    {

        //Los clientes tienen propiedades y las propiedades estan en una sucursal

        $this->authorize('access-function', 'customer-list');
        $this->business = Auth::user()->business->with([
            'propertiesTypes' => fn($query) => $query->select(['id', 'name', 'business_id']),
            'branches' => fn($query) => $query->select(['id', 'name', 'business_id']),
            'provinces' => fn($query) => $query->select(['id', 'province_id', 'provinceable_id']),

        ])->first();

        $this->propertyTypes = $this->business->propertiesTypes->toArray();
        $this->branches = $this->business->branches->toArray();

        $this->frequencies = collect(FrequencyEnum::cases())->map(function ($frequencyEnum) {
            return [
                'id' => $frequencyEnum->value,
                'name' => FrequencyEnum::getFrequency($frequencyEnum),
            ];
        })->toArray();

        $this->branchesIds = $this->business->branches->pluck('id');

        $this->chargueZones();
    }


    public function getLastVisitStatus($customer)
    {

        $lastVisitStatus = $customer->lastVisit->first()->status ?? null;

        return match ($lastVisitStatus) {
            StatusVisitEnum::PENDING, StatusVisitEnum::ONTHEWAY, StatusVisitEnum::INPROGRESS => 'blue',
            StatusVisitEnum::COMPLETED, StatusVisitEnum::RESCHEDULED => 'green',
            StatusVisitEnum::CANCELLED => 'orange',
            StatusVisitEnum::INCOMPLETE => 'red',
            default => 'gray',
        };
    }

    #[On('update-selected-value-zones')]
    public function updateSelectedZones($value)
    {

        $this->selectedZone = $value;

        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-search-zones')]
    public function updateSearchZone($search)
    {

        $this->searchZone = $search;

        $this->chargueZones();
        $this->resetPage();
    }

    #[On('update-selected-value-propertyTypes')]
    public function updateSelectedPropertyTypes($value)
    {

        $this->selectedPropertyType = $value;

        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-frequencies')]
    public function updateSelectedFrequency($value)
    {
        $this->selectedFrequency = $value;

        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-branches')]
    public function updateSelectedBranch($value)
    {
        $this->selectedBranch = $value;

        $this->updateCountFilters();
        $this->resetPage();
    }


    public function updateCountFilters()
    {
        $this->countFilters = 0;
        if ($this->selectedZone) {
            $this->countFilters++;
        }
        if ($this->selectedPropertyType) {
            $this->countFilters++;
        }
        if ($this->selectedFrequency) {
            $this->countFilters++;
        }
        if ($this->selectedBranch) {
            $this->countFilters++;
        }
    }


    public function resetFilters()
    {
        if ($this->selectedZone) {
            $this->dispatch('clear-selected-value-zones', $this->selectedZone['id']);
        }
        if ($this->selectedPropertyType) {
            $this->dispatch('clear-selected-value-propertyTypes', $this->selectedPropertyType);
        }
        if ($this->selectedFrequency) {
            $this->dispatch('clear-selected-value-frequencies', $this->selectedFrequency);
        }
        if ($this->selectedBranch) {
            $this->dispatch('clear-selected-value-branches', $this->selectedBranch);
        }
    }

    public function updateSort($value)
    {
        $this->sort = $value;
        $this->resetPage();
    }

    public function chargueZones()
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

    public function render()
    {
        $businessId = auth()->user()->business_id;


        // Determinar si se han aplicado filtros relacionados con propiedades
        $hasPropertyFilters = $this->selectedZone || $this->selectedPropertyType || $this->selectedFrequency || $this->selectedBranch;

        $query = Customer::where('business_id', $businessId)
            ->where('status', StatusCustomerEnum::CLOSED)
            ->select(['id', 'name', 'surname', 'created_by', 'created_at'])
            ->withCount([
                'properties' => function ($query) {
                    $query->whereIn('branch_id', $this->branchesIds);
                }
            ])
            ->with([
                'properties' => function ($query) {
                    $query->select('id', 'customer_id', 'address', 'photo', 'frequency')
                        ->whereIn('branch_id', $this->branchesIds);
                },
                'createdBy:id,name',
                'lastVisit:id,customer_id,status',
            ]);

        // Si no hay filtros aplicados, incluimos a los clientes sin propiedades
        if (!$hasPropertyFilters) {
            $query->where(function ($q) {
                $q->whereHas('properties', function ($q2) {
                    $q2->whereIn('branch_id', $this->branchesIds);
                })
                    ->orDoesntHave('properties');
            });
        } else {
            // Si hay filtros aplicados, solo consideramos clientes con propiedades que cumplan con los filtros
            $query->whereHas('properties', function ($q) {
                $q->whereIn('branch_id', $this->branchesIds);

                if ($this->selectedZone) {
                    $selectedZone = $this->selectedZone;
                    $model = $selectedZone['model'];
                    $id = $selectedZone['id'];

                    if ($model === 'Provincia') {
                        $q->where('province_id', $id);
                    } elseif ($model === 'Ciudad') {
                        $q->where('city_id', $id);
                    } elseif ($model === 'Barrio') {
                        $q->where('neighborhood_id', $id);
                    } elseif ($model === 'Subzona') {
                        $q->where('subzone_id', $id);
                    }
                }

                if ($this->selectedPropertyType) {
                    $q->where('property_type', $this->selectedPropertyType);
                }

                if ($this->selectedFrequency) {
                    $q->where('frequency', $this->selectedFrequency);
                }

                if ($this->selectedBranch) {
                    $q->where('branch_id', $this->selectedBranch);
                }
            });
        }

        // Aplicar orden y paginación
        $customers = $query->orderBy('created_at', $this->sort === 'newest' ? 'desc' : 'asc')
            ->paginate(10);

        return view('livewire.panel.customers.list-customer', [
            'customers' => $customers
        ])->layout('layouts.panel');
    }
}
