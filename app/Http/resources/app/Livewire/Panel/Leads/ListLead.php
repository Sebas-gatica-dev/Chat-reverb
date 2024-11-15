<?php

namespace App\Livewire\Panel\Leads;

use App\Enums\SourceEnum;
use App\Enums\StatusBudgetEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
use App\Models\Budget;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Database\Eloquent\Builder;
use function Spatie\LaravelPdf\Support\pdf;



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
    #[Url(as: 'tipo-contacto')]
    public $selectedContactType;
    public $leadsStats;




    public $sort = 'newest';

    public $searchZone;

    public $business;

    #[Url(as: 'buscar')]
    public $searchTerm = '';


    //Propiedades para actividades del lead

    public $showActivityModal = false;
    public $selectedLead;
    public $activityTypeContact;
    public $activityComment;
    public $activityId = null; // Para edición

    public $type_contacts;
    //Fin propiedades para actividades del lead


    // public $totalLeads;







    // public function getListeners()
    // {
    //     // return [
    //     //     "echo-private:App.Models.Order.{$this->order},NewOrderNotification', => 'orderNofication',

    //     // ];
    //     // #[On('echo-private:budgets-channel.{budgetId},BudgetPdfGenerated')]

    //     return [


    //         // Private Channel
    //         "echo-private:budgets-channel.{budgetId},BudgetPdfGenerated" => 'onBudgetPdfGenerated',


    //     ];
    // }






    public function mount()
    {
        $this->business = auth()->user()->business;

        // Initialize filter options
        $this->changeZones();

        // leads-show

        $this->users = User::where('business_id', $this->business->id)->whereHas('roles', function (Builder $query) {
            $query->whereHas('features', function (Builder $query) {
                $query->where('slug', 'leads-show');
            });
        })->get()->map(function ($user) {
            return ['id' => $user->id, 'name' => $user->name];
        })->toArray();


        $this->statuses = collect(StatusCustomerEnum::cases())->map(function ($status) {
            return ['id' => $status->value, 'name' => $status->getName()];
        })->toArray();  


        $this->propertyTypes = PropertyType::where('business_id', $this->business->id)->get()->map(function ($type) {
            return ['id' => $type->id, 'name' => $type->name];
        })->toArray();



        $this->sources = collect(SourceEnum::cases())->map(function ($source) {
            return ['id' => $source->value, 'name' => $source->getName()];
        })->toArray();



        $this->type_contacts = collect(TypeContactEnum::cases())->map(function ($source) {
            return ['id' => $source->value, 'name' => $source->getName()];
        })->toArray();


        // //Para actividad
        // $this->type_contacts = TypeContactEnum::cases();

        // Initialize filters to show leads of the current month by default
        $this->selectedDateStart =  $this->selectedDateStart ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->selectedDateEnd = $this->selectedDateEnd ?? Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->updateCountFilters();

        // dd($this->selectedDateStart);


        // // Initialize filters
        // $this->selectedDateStart = null;
        // $this->selectedDateEnd = null;
    }




    public $filteredLeadIds = [];
    public $totalLeads = 0;
    public $averageBudget = 0;
    public $effectivenessPercentage = 0;
    public $leadsToday = 0;

    #[Computed]
    public function leads()
    {
        $query = $this->getLeadsQuery();
        // dd($query->get());
        // Obtener los IDs de los leads filtrados
        $this->filteredLeadIds = $query->pluck('customers.id')->toArray();

        // Paginar los leads para la vista
        $leads = $query->paginate(10);

        // Calcular las estadísticas usando los IDs obtenidos
        $this->calculateStatistics();

        return $leads;
    }




    protected function getLeadsQuery()
    {
        $query = Customer::where('business_id', $this->business->id)
            ->where('status', '!=', StatusCustomerEnum::CLOSED->value)
            ->select('id', 'name', 'surname', 'source', 'date_lead', 'time_lead', 'email', 'type_contact', 'status', 'service_id', 'created_by')->with([
                'firstProperty' => function ($query) {
                    $query->select(
                        'id',
                        'customer_id',
                        'property_type',
                        'neighborhood_id',
                        'city_id'
                    );
                },
                'service' => function ($query) {
                    $query->select('id', 'name');
                },
                'firstProperty.neighborhood' => function ($query) {
                    $query->select('id', 'name');
                },
                'firstProperty.city' => function ($query) {
                    $query->select('id', 'name');
                },
                'budget',
                'leadActivities.user',
                'firstPhone',
                'firstProperty.propertyType',
                'createdBy' => function ($query) {
                    $query->select('id', 'name');
                },
            ]);



        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('surname', 'like', $searchTerm)
                    ->orWhereHas('service', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('firstProperty.neighborhood', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('firstProperty.city', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('firstPhone', function ($query) use ($searchTerm) {
                        $query->where('number', 'like', $searchTerm);
                    });
            });
        } else {
            $query = $this->applyFilters($query);
        }

        // Aplicar ordenamiento
        $query->orderBy('created_at', $this->sort === 'newest' ? 'desc' : 'asc');

        return $query;
    }





    protected function calculateStatistics()
    {
        $totalLeads = count($this->filteredLeadIds);


        $this->totalLeads = $totalLeads;

        if ($totalLeads === 0) {
            $this->averageBudget = 0;
            $this->effectivenessPercentage = 0;
            $this->leadsToday = 0;
            return;
        }

        // Leads Presupuestados y Total de Presupuestos
        $budgetedLeadsData = Customer::whereIn('customers.id', $this->filteredLeadIds)
            ->where('customers.status', StatusCustomerEnum::BUDGETED)
            ->leftJoin('budgets', 'customers.id', '=', 'budgets.customer_id')
            ->selectRaw('COUNT(customers.id) as count, SUM(budgets.total) as total_budget')
            ->first();

        // dd($budgetedLeadsData);


        $budgetedLeadsCount = $budgetedLeadsData->count;
        $totalBudget = $budgetedLeadsData->total_budget ?? 0;

        //dd($budgetedLeadsCount, $totalBudget);

        $this->averageBudget = $budgetedLeadsCount > 0 ? $totalBudget / $budgetedLeadsCount : 0;



        // dd($this->averageBudget);
        // Leads Cerrados
        // $closedStatus = StatusCustomerEnum::CLOSED;

        $allCustomers = Customer::where('business_id', $this->business->id);
        $allCustomers = $this->applyFilters( $allCustomers)->count();



        $closedLeadsCount = Customer::where('business_id', $this->business->id)
            ->where('customers.status', StatusCustomerEnum::CLOSED);
        $closedLeadsCount = $this->applyFilters($closedLeadsCount)->count();
           
     

        $this->effectivenessPercentage = $this->totalLeads > 0 ? round(($closedLeadsCount / $allCustomers) * 100, 2) : 0;


        // Leads de Hoy
        $today = Carbon::today()->format('Y-m-d');

        $this->leadsToday = Customer::whereIn('customers.id', $this->filteredLeadIds)
            ->whereDate('customers.date_lead', $today)
            ->count();
    }



    protected function applyFilters($query)
    {
        //dd($query->get());
        // Filter by zone
        $query->when($this->selectedZone, function ($query) {


            $query->whereHas('firstProperty', function ($query) {
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
            });
        })->when($this->selectedDateStart && $this->selectedDateEnd, function ($query) {

            // dd('aca llueg1');
            $query->whereDate('date_lead', '>=', $this->selectedDateStart)
                ->whereDate('date_lead', '<=', $this->selectedDateEnd);
        })->when($this->selectedUser, function ($query) {

            $query->where('created_by', $this->selectedUser);
        })->when($this->selectedStatus, function ($query) {

            $query->where('status', $this->selectedStatus);
        })->when($this->selectedPropertyType, function ($query) {

            $query->whereHas('firstProperty', function ($query) {

                $query->where('property_type', $this->selectedPropertyType);
            });
        })->when($this->selectedSource, function ($query) {

            $query->where('source', $this->selectedSource);
        })->when($this->selectedContactType, function ($query) {

            $query->where('type_contact', $this->selectedContactType);
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
        if ($this->selectedContactType) $this->countFilters++;
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

    #[On('update-selected-value-type-contact')]
    public function updateSelectedContactType($value)
    {

        $this->selectedContactType = $value;
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
        // $this->resetPage();
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



    public function checkBudgetStatus()
    {
        $this->leads();
    }

    public function viewPdf(Budget $budget)
    {
        return redirect()->route('panel.pdf.budget');
    }

    //METODOS PARA ACTIVIDADES DEL LEAD

    public function openActivityModal($leadId)
    {
        $this->selectedLead = Customer::with('activities.user')->findOrFail($leadId);
        $this->activityTypeContact = null;
        $this->activityComment = null;
        $this->activityId = null;
        $this->showActivityModal = true;
    }


    public function saveActivity()
    {
        $this->validate([
            'activityTypeContact' => 'required',
            'activityComment' => 'nullable|string',
        ]);

        if ($this->activityId) {
            // Editar actividad existente
            $activity = LeadActivity::findOrFail($this->activityId);
            $activity->update([
                'type_contact' => $this->activityTypeContact,
                'comment' => $this->activityComment,
            ]);
        } else {
            // Crear nueva actividad
            LeadActivity::create([
                'customer_id' => $this->selectedLead->id,
                'user_id' => auth()->id(),
                'date' => now()->format('Y-m-d'),
                'time' => now()->format('H:i:s'),
                'type_contact' => $this->activityTypeContact,
                'comment' => $this->activityComment,
                'is_initial' => false,
            ]);
        }

        $this->showActivityModal = false;

        // Refrescar las actividades del lead
        $this->selectedLead->load('activities.user');
    }

    public function editActivity($activityId)
    {
        $activity = LeadActivity::findOrFail($activityId);

        if ($activity->is_initial) {
            session()->flash('notification', [
                'message' => 'No se puede editar la actividad inicial.',
                'type' => 'warning',
            ]);
            return;
        }

        $this->activityId = $activity->id;
        $this->selectedLead = $activity->lead;
        $this->activityTypeContact = $activity->type_contact;
        $this->activityComment = $activity->comment;
        $this->showActivityModal = true;
    }

    public function deleteActivity($activityId)
    {
        $activity = LeadActivity::findOrFail($activityId);

        if ($activity->is_initial) {
            session()->flash('notification', [
                'message' => 'No se puede eliminar la actividad inicial.',
                'type' => 'warning',
            ]);
            return;
        }

        $activity->delete();

        // Refrescar las actividades del lead
        $this->selectedLead->load('activities.user');
    }

    public function generatePdf($budgetId)
    {
        $budget = Budget::find($budgetId);

        $budget->update([
            'status' => StatusBudgetEnum::GENERATING->value
        ]);
        $budget->save();

        // Dispatch job to generate PDF
        dispatch(new \App\Jobs\GenerateBudgetPdf($budget->id));

        $this->leads();
    }
    

    public function render()
    {
        return view('livewire.panel.leads.list-lead')
            ->layout('layouts.panel', ['title' => 'Leads']);
    }
}
