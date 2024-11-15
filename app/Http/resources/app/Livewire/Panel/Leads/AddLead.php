<?php

namespace App\Livewire\Panel\Leads;

use App\Enums\GenderEnum;
use App\Enums\SourceEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Mechanisms\HandleComponents\HandleComponents;

class AddLead extends Component
{

    public $name;
    public $surname;
    public $date;
    public $time;
    public $email;
    public $gender;
    public $phone;
    public $source;
    public $type_contact;
    public $status;
    public $description;
    public $province_id;
    public $city_id;
    public $neighborhood_id;
    public $subzone_id;
    public $property_type_id;
    public $service_id;
    public $branch_id;
    public $created_by;

    // Collections for select inputs
    public $sources;
    public $type_contacts;
    public $statuses;
    public $property_types;
    public $services;
    public $branches;
    public $users;
    public $provinces;
    public $cities = [];
    public $neighborhoods = [];
    public $subzones = [];


    #[Url(as: 'paso')]
    public $currentStep = 1;


    public $completedSteps = [];

    public array $statusesArray = [];

    public array $formsData = [];


    public $lead;


    public $blockedSteps;

    public function mount($lead = null)
    {

        if ($lead) {
          

            $this->loadingLead($lead);

            $phones = array_merge($this->lead->phones->toArray(), $this->lead->firstProperty->phones->toArray());

            //ordenar por order
            usort($phones, function ($a, $b) {
                return $a['order'] <=> $b['order'];
            });

          
            $this->formsData = [
                'customer' => $this->lead->toArray(),
                'property' => $this->lead->firstProperty->toArray(),
                'phones' => [
                    'customer_id' => $this->lead->id,
                    'property_id' => $this->lead->firstProperty->id,
                    'phones' => $phones,
                ],
                'files' => $this->lead->firstProperty,
                'budget' => $this->lead->budget ? $this->lead->budget->toArray() : [],
            ];



            $this->statuses = StatusCustomerEnum::cases();


            if (!$this->lead->status) {
                $this->status = StatusCustomerEnum::IN_PROCESS->value;
            } else {
                $this->status = $this->lead->status;
            }


            $this->statusesArray = collect($this->statuses)
                ->filter(function ($statusEnum) {
                    return $statusEnum->value !== StatusCustomerEnum::NOT_CLOSED->value && $statusEnum->value !== StatusCustomerEnum::CLOSED->value;
                })
                ->map(function ($statusEnum) {
                    return [
                        'value' => $statusEnum->value,
                        'name' => $statusEnum->getName(),
                        // Incluir clases de estilo
                        'bgClass' => $statusEnum->getBadgeClasses(),

                        'icon' => $statusEnum->getIcon(),
                        'description' => $statusEnum->getDescription(),
                    ];
                })
                ->values()
                ->toArray();

            $this->calculateCompletedSteps();
        } else {
            $this->formsData = [
                'customer' => [
                    'name' => null,
                    'surname' => null,
                    'business_name' => null,
                    'date_lead' => now()->format('Y-m-d'),
                    'time_lead' => now()->format('H:i'),
                    'type_contact' => null,
                    'gender' => null,
                    'email' => null,
                    'phone' => null,
                    'source' => null,
                    'description' => null,
                    'service_id' => null,
                    'created_by' => auth()->user()->id,


                ]
            ];

            $this->blockedSteps = [2, 3, 4, 5, 6, 7];
        }

        // Load enum cases
        $this->sources = SourceEnum::cases();
        $this->type_contacts = TypeContactEnum::cases();


        // Load models
        $this->property_types = PropertyType::where('business_id', auth()->user()->business_id)->get();
        $this->services = Service::where('business_id', auth()->user()->business_id)->get();
        $this->branches = Branch::where('business_id', auth()->user()->business_id)->get();
        $this->users = User::where('business_id', auth()->user()->business_id)->get();
        $this->provinces = Province::whereIn('id', auth()->user()->business->provinces->pluck('province_id'))->get();
    }


    public function loadingLead($lead = null){

        $this->lead = Customer::where('id', $lead)
        ->where('business_id', auth()->user()->business_id)
        ->where('status', '!=', StatusCustomerEnum::CLOSED)
        ->select('id', 'name', 'surname', 'date_lead', 'time_lead', 'type_contact', 'gender', 'status', 'email', 'created_by',  'business_id', 'business_name', 'service_id', 'source')
        ->with([
            'firstProperty' => function ($query) {
                $query->select('id', 'property_name', 'property_type', 'documentation', 'frequency', 'branch_id', 'address', 'between_streets', 'floor', 'apartment', 'province_id', 'city_id', 'neighborhood_id', 'subzone_id', 'latitude', 'longitude', 'customer_id');
            },


            'phones' => function ($query) {
                $query->select('id', 'number', 'tag', 'type', 'phoneable_id', 'phoneable_type', 'order');
            },
            'firstProperty.phones' => function ($query) {
                $query->select('id', 'number', 'tag', 'type', 'phoneable_id', 'phoneable_type', 'order');
            },
            'firstProperty.files' => function ($query) {
                $query->select('id', 'name', 'path', 'fileable_id', 'fileable_type');
            },
            'firstProperty.availabilities' => function ($query) {
                $query->select('id', 'day', 'start_time', 'end_time', 'availabilitable_id', 'availabilitable_type');
            },
            'firstProperty.specialAvailabilities' => function ($query) {
                $query->select('id', 'specific_date', 'start_time', 'end_time', 'available_id', 'available_type');
            },

            'firstProperty.budget',


            'leadFirstActivity' => function ($query) {
                $query->select('id', 'date', 'time', 'type_contact', 'comment', 'is_initial', 'customer_id', 'user_id');
            },

            'budget', // Include budget and related budgetems
            'budget.budgetems',
            'budget.products',
            'budget.products.units',
            'budget.privateBudgetems',
            'budget.publicBudgetems', // Include budget
            'budget.customer.firstProperty'


        ])

        ->firstOrFail();

    }




    #[On('updateDataLeadAndStep')]
    public function updatedDataLeadAndStep($step)
    {
        $this->loadingLead($this->lead->id);
        
        if($step == 1) $this->formsData['customer'] = $this->lead->toArray();
        if($step == 2) $this->formsData['property'] =  $this->lead->firstProperty->toArray();
        if($step == 3) {
        $phones = array_merge($this->lead->phones->toArray(), $this->lead->firstProperty->phones->toArray());
        usort($phones, function ($a, $b) { return $a['order'] <=> $b['order']; });
        $this->formsData['phones'] = ['customer_id' => $this->lead->id, 'property_id' => $this->lead->firstProperty->id, 
        'phones' => $phones];
        }
        if($step == 4) $this->formsData['files'] = $this->lead->firstProperty;
        if($step == 6) $this->formsData['budget'] = $this->lead->budget ? $this->lead->budget->toArray() : [];
        $this->calculateCompletedSteps();
    }

    public function calculateCompletedSteps()
    {

        $this->completedSteps = [];
        $this->blockedSteps = [];
        // Definir los pasos y sus campos requeridos
        $steps = [
            1 => [
                'data' => $this->formsData['customer'],
                'required_fields' => [
                    'id',
                    'date_lead',
                    'name',
                    'surname',
                    'time_lead',
                    'type_contact',
                    'gender',
                    'email',
                    'source',
                    'lead_first_activity',
                    'created_by'
                ]

            ],
            2 => [
                'data' => $this->formsData['property'],
                'required_fields' => [
                    'address',
                    'between_streets',
                    'latitude',
                    'longitude',
                    'province_id',
                    'city_id',
                    'neighborhood_id',
                    'property_type',
                    'frequency',
                    'branch_id',

                ],
            ],
            3 => [
                'data' => $this->formsData['phones']['phones'],
                'required_fields' => ['id'], // Para teléfonos, solo verificamos si hay datos
            ],
            4 => [
                'data' => $this->formsData['files']->files->toArray(),
                'required_fields' => ['id'], // Puedes agregar campos requeridos si es necesario
            ],
            6 => [
                'data' => $this->formsData['budget'],
                'required_fields' => ['id'], // Puedes agregar campos requeridos si es necesario
            ],
            // Agrega más pasos según sea necesario
        ];



        foreach ($steps as $stepNumber => $stepInfo) {
            $data = $stepInfo['data'];
            $requiredFields = $stepInfo['required_fields'];

            $isCompleted = true;


            // Si el data es un array numérico (como en teléfonos), verificamos si no está vacío
            if (is_array($data) && array_values($data) === $data) {
                $isCompleted = !empty($data);
            } else {
                // Verificamos que todos los campos requeridos no estén vacíos
                foreach ($requiredFields as $field) {
                    if (empty($data[$field])) {

                        $isCompleted = false;
                        break;
                    }
                }
            }

            if ($isCompleted) {
                $this->completedSteps[] = $stepNumber;
            }
        }
        // Lógica para bloquear pasos
        // dd(!in_array(1 , $this->completedSteps));
        // Por ejemplo, bloquear el paso 5 si el paso 2 no está completado

        // Lógica para bloquear pasos
        $requiredSteps = [1, 2];
        $missingSteps = array_diff($requiredSteps, $this->completedSteps);

        if (!empty($missingSteps)) {
            // Si faltan pasos requeridos, bloquear los pasos 5 y 7
            array_push($this->blockedSteps, 5, 7);
        }
    }


    #[On('update-status')]
    public function updateStatus()
    {
        // Si deseas realizar acciones adicionales cuando el estado cambia
        $this->status = $this->lead->status;
    }

    public function render()
    {
        return view('livewire.panel.leads.add-lead')
            ->layout('layouts.panel', ['title' => 'Leads']);
    }
}
