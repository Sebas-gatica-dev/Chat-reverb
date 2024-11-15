<?php

namespace App\Livewire\Panel\Property;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Livewire\Panel\Property\Visit\Modals\ModalVisitStatusData;
// use App\Livewire\Panel\Property\Visit\Modals\ModalVisitStatusData;
use App\Models\Budget;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Input;
use App\Models\InputData;
use App\Models\Phone;
use App\Models\Property;
use App\Models\StatusChange;
use App\Models\Visit;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\WithPagination;





class ShowProperty extends Component
{
    public $customer;
    public $property;
    public $business;
    public $phoneForm;
    public $phoneNumberForm;
    public $phoneTagForm;
    public $phoneModelForm;
    public $phoneTypeForm;
    public $perPage = 6;
    //filters
    public $selectedVisitType;
    public $visitType = [];
    public $selectedStatus;
    public $status = [];
    public $selectedUser;
    public $users = [];
    public $selectedService;
    public $services = [];
    public $currentSection;
    
    public $budgets;


//    VARIABLES DE MODALES SHOW-VISIT

    // VARIABLES MODAL STATUS CHANGE
    public $modalStatusChangeData = false;
    public $statusChange;
    public $defaultDataFields = [];
    public $dataFormsDynamic = [];
    public $statusName;
    public $currentVisit;
    public $visitStatus;



    // FIN DE VARIABLES STATUS CHANGE


      // VARIABLES MODAL VISIT INFO
    
      // FIN DE VARIABLES VISIT INFO


//    FIN DE VARIABLES SHOW-VISIT


  // VARIABLES MODAL SHOW AVAILABILITIES
  public $modalShowAvailabilities = false;
  public $grupedAvailabilities = [];
  public $propertyAvailabilities = [];
  public $visitAvailabilities = [];


  // FIN DE VARIABLES SHOW AVAILABILITIES

    

    use WithPagination;

    public function mount()
    {
        $this->authorize('access-function', 'property-show');
        $this->business = auth()->user()->business()->select(['id', 'name'])->with([
            'visitsTypes' => fn($query) => $query->select(['id', 'name', 'business_id']),
            'users' => fn($query) => $query->select(['id', 'name', 'photo as image', 'business_id']),
            'services' => fn($query) => $query->select(['id', 'name', 'business_id']),
        ])->firstOrFail();

        // dd($this->business);
        

        if(Gate::allows('access-function', 'visit-list')){
            $this->currentSection = 1;
        }else{
            $this->currentSection = 2;
        }





        $this->customer = Customer::select([
            'id',
            'created_by',
            'name',
            'surname',
            'email',
            'business_name',
            'created_at',
     
        ])->where('id', $this->customer)->with([
            'createdBy' => fn($query) => $query->select(['id', 'name']),
            'phones' => fn($query) => $query->select(['id', 'number', 'tag', 'type', 'order', 'phoneable_id', 'phoneable_type']),
            'budgets'
        ])->firstOrFail();

        //  dd($this->customer);

        $this->property = Property::select([
            'id',
            'address',
            'photo',
            'latitude',
            'longitude',
            'frequency',
            'property_name',
            'city_id',
            'neighborhood_id',
            'subzone_id',
            'floor',
            'apartment',
            'between_streets',
            'property_type',
            'customer_id',
            'documentation',
       
        ])->where('id', $this->property)->with([
            'phones' => fn($query) => $query->select(['id', 'number', 'tag', 'type', 'order', 'phoneable_id', 'phoneable_type']),
            'visits' => fn($query) => $query->select(['id', 'property_id', 'visit_type_id', 'status', 'date', 'time', 'duration_time']),
            'visits.visitType' => fn($query) => $query->select(['id', 'name']),
            'budgets',
            'visits.users' => fn($query) => $query->select(['id', 'name']),
            'visits.services' => fn($query) => $query->select(['id', 'name']),
            'city' => fn($query) => $query->select(['id', 'name']),
            'neighborhood' => fn($query) => $query->select(['id', 'name']),
            'propertyType' => fn($query) => $query->select(['id', 'name']),
        ])->firstOrFail();

        // dd( $this->property);

        // dd($this->property);

        $this->budgets = $this->customer->budgets;
           


        $this->status = collect(StatusVisitEnum::cases())->map(function ($statusEnum) {
            return [
                'id' => $statusEnum->value,
                'name' => StatusVisitEnum::getStatus($statusEnum),
            ];
        })->toArray();


        $this->users = $this->business->users->toArray();

        $this->services = $this->business->services->toArray();

        $this->visitType = $this->business->visitsTypes->toArray();
    }


    public function getListeners()
    {
        return [
            'open-show-availabilities-modal' => 'openShowAvailabilitiesModal',
        ];
    }


    #[On('update-selected-value-visit-type')]
    public function updateSelectedVisitType($value)
    {
        $this->selectedVisitType = $value;

        $this->resetPage();
    }


    #[On('update-selected-value-status')]
    public function updateSelectedStatus($value)
    {
        $this->selectedStatus = $value;

        $this->resetPage();
    }


    #[On('update-selected-value-user')]
    public function updateSelectedUser($value)
    {
        $this->selectedUser = $value;

        $this->resetPage();
    }
    #[On('update-selected-value-service')]
    public function updateSelectedService($value)
    {
        $this->selectedService = $value;

        $this->resetPage();
    }
    public function addPhone()
    {
        $this->reset('phoneForm', 'phoneNumberForm', 'phoneTagForm', 'phoneModelForm', 'phoneTypeForm');
        $this->dispatch('open-phone-form');
    }


    public function editPhone($phoneId)
    {
        $this->authorize('access-function', 'phone-edit');
        $this->phoneForm = Phone::find($phoneId);
        $this->phoneNumberForm = $this->phoneForm->number;
        $this->phoneTagForm = $this->phoneForm->tag;

        if ($this->phoneForm->phoneable_type == 'App\Models\Customer') {
            $this->phoneModelForm = 'customer';
        } else {
            $this->phoneModelForm = 'property';
        }

        $this->phoneTypeForm = $this->phoneForm->type;

        $this->dispatch('open-phone-form');
    }

    public function deletePhone($phoneId)
    {
        $this->authorize('access-function', 'phone-delete');
        $phoneForm = Phone::find($phoneId);

        if ($phoneForm) {
            $phoneForm->delete();

            $this->dispatch('notification', [
                'message' => 'Teléfono eliminado correctamente',
                'type' => Notifications::icons('success')
            ]);
        }

        $this->reset('phoneForm');
    }

    public function orderPhone($order)
    {

        foreach ($order as $phone) {
            $phoneModel = Phone::find($phone['value']);
            $phoneModel->order = $phone['order'];
            $phoneModel->save();
        }
    }


    public function savePhone()
    {

        $this->authorize('access-function', 'phone-add');
        $this->validate([
            'phoneNumberForm' => 'required',
            'phoneTagForm' => 'required',
            'phoneModelForm' => 'required',
            'phoneTypeForm' => 'required',
        ]);

        if ($this->phoneForm) {
            $this->phoneForm->update([
                'number' => $this->phoneNumberForm,
                'tag' => $this->phoneTagForm,
                'type' => $this->phoneTypeForm,
            ]);

            if ($this->phoneModelForm == 'customer') {
                $this->phoneForm->phoneable_id = $this->customer->id;
                $this->phoneForm->phoneable_type = 'App\Models\Customer';
                $this->phoneForm->save();
            } else {
                $this->phoneForm->phoneable_id = $this->property->id;
                $this->phoneForm->phoneable_type = 'App\Models\Property';
                $this->phoneForm->save();
            }
        } else {


            $phones = array_merge($this->customer->phones->toArray(), $this->property->phones->toArray());


            if (!authorizeFeatureCount('phone-add', $phones, $this)) {
                $this->dispatch('close-phone-form');
                return;
            }

        

            Phone::create([
                'number' => $this->phoneNumberForm,
                'tag' => $this->phoneTagForm,
                'type' => $this->phoneTypeForm,
                'order' => $phones ? Arr::last($phones)['order'] + 1 : 1,
                'phoneable_id' => $this->phoneModelForm == 'customer' ? $this->customer->id : $this->property->id,
                'phoneable_type' => $this->phoneModelForm == 'customer' ? 'App\Models\Customer' : 'App\Models\Property',
            ]);



        }


        $this->customer->load('phones');
        $this->property->load('phones');
        $this->dispatch('close-phone-form');
        $this->reset('phoneForm');
    }

    public function deleteProperty()
    {
        $this->authorize('access-function', 'property-soft');
        if ($this->property->visits->count() > 0) {

            $this->dispatch('notification', [
                'message' => 'No se puede eliminar la propiedad porque tiene visitas asociadas',
                'type' => Notifications::icons('error')
            ]);
        } else {
            $this->property->delete();



            session()->flash('notification', [
                'message' => 'Propiedad eliminada correctamente',
                'type' => Notifications::icons('success')
            ]);
        }

        if ($this->customer->properties->count() > 0) {
            return redirect()->route('panel.customers.show', $this->customer->id);
        }
        return redirect()->route('panel.customers.list');
    }

    public function loadMore()
    {
        $this->perPage += 8;
    }


    public function changeSection($section)
    {
        $this->currentSection = $section;
    }



    // LOGICA DE MODALES SHOW-VISIT



        // MODAL STATUS CHANGE DATA
        #[On('open-status-change-data-modal')]
        public function openStatusChangeDataModal($status, $visit)
        {
            $this->currentVisit = $visit;

            //    dd($this->visit);
               $this->visitStatus = $this->currentVisit['status'];
        
                $enumCase = StatusVisitEnum::getSectorName($status);
                $this->statusName = StatusVisitEnum::getStatus($enumCase);
              $this->loadStatusChange($status, $visit);
              $this->loadDataFormsDynamic($status, $visit);

            // $this->dispatch('load-status-change-data-modal', [
            //     'status' => $status,
            //     'visit' => $visit,
            // ])->to(ModalVisitStatusData::class);
            // dd($this->defaultDataFields, $this->dataFormsDynamic);
             $this->modalStatusChangeData = true;
        }


        #[On('cancelAction')]
        public function cancelAction()
        {
            $this->modalStatusChangeData = false;
            $this->resetModal();
        }


        public function resetModal(){

        
        }



        public function loadStatusChange($status, $visit)
        {
            $enumCase = StatusVisitEnum::getSectorName($status);
          
            $this->statusChange = StatusChange::where('visit_id', $visit['id'])
                ->where('status', $enumCase->value)
                ->first();
            //  dd($this->statusChange);
            if (!is_null($this->statusChange->data)) {
    
                $defaultFieldsData = json_decode($this->statusChange->data, true);
    
    
                $this->defaultDataFields = $defaultFieldsData;
            }

            // dd($this->defaultDataFields);
        }
        


    

        
        public function loadDataFormsDynamic($status, $visit)
        {
            $this->dataFormsDynamic = Input::where('business_id', auth()->user()->business_id)
                ->where('sector', $status)
                ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
                ->orderBy('order', 'asc') // Ordenar por el campo 'order'
                ->get()->toArray();
            if ($this->dataFormsDynamic) {
                foreach ($this->dataFormsDynamic as &$input) {

                    $inputData = InputData::where('input_id', $input['id'])
                        ->where('modeable_type', 'App\Models\StatusChange')
                        ->where('modeable_id', $this->statusChange->id)
                        ->get()->toArray();

                    // dd($inputData);

                    if ($inputData) {
                        $input['input_data'] = $inputData;
                    }
                }
            }

            //  dd($this->dataFormsDynamic);
        }











        // FIN MODAL STATUS CHANGE DATA








    // INICIO MODAL VISIT INFO


    // FIN MODAL VISIT INFO



     // INICIO MODAL SHOW AVAILABILITIES

        // #[On('open-show-availabilities-modal')]
        public function openShowAvailabilitiesModal($model, $modelId)
        {
            if ($model == 'property') {
                // $property = Property::find($modelId);
                // $this->grupedAvailabilities = $this->sortWeekDays($this->property->availabilities->toArray());
                $this->grupedAvailabilities = $this->sortWeekDays($this->property->availabilities->groupBy('day')->toArray());
                // dd($this->grupedAvailabilities);

             
            } elseif ($model == 'visit') { 
                $visit = Visit::find($modelId);
                $this->grupedAvailabilities = $this->sortWeekDays($visit->availabilities->groupBy('day')->toArray());
            }
            $this->modalShowAvailabilities = true;
        }
        
        public function sortWeekDays($array)
        {
            $order = [
                'monday' => 1,
                'tuesday' => 2,
                'wednesday' => 3,
                'thursday' => 4,
                'friday' => 5,
                'saturday' => 6,
                'sunday' => 7,
            ];
            
            // Función de ordenamiento usando el orden de los días
            uksort($array, function ($a, $b) use ($order) {
                return $order[$a] <=> $order[$b];
            });
            
            return $array; // Retornar el array ordenado
        }
        

    
        public function translateDay($day)
        {
            $days = [
                'monday' => 'Lunes',
                'tuesday' => 'Martes',
                'wednesday' => 'Miércoles',
                'thursday' => 'Jueves',
                'friday' => 'Viernes',
                'saturday' => 'Sábado',
                'sunday' => 'Domingo',
            ];

            return $days[$day] ?? $day;
        }



        #[On('close-show-availabilities-modal')]
        public function closeShowAvailabilitiesModal()
        {

            $this->grupedAvailabilities = [];
            $this->modalShowAvailabilities = false;
            // $this->dispatch('close-show-availabilities-modal');
        }

    // FIN MODAL SHOW AVAILABILITIES








    // #[On('cancelAction')]
    // public function cancelAction()
    // {
    //     $this->showConfirmationModal = false;
    //     $this->resetModal();
    // }



    // FINAL LOGICA MODALES SHOW-VISIT





    public function render()
    {



        $phonesCustomer = $this->customer->phones->toArray();
        $phonesProperty = $this->property->phones->toArray();



        $mergePhones = array_merge($phonesCustomer, $phonesProperty);

        usort($mergePhones, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });


        $visits = $this->property->visits()
        ->with('comments', 'users', 'services', 'visitType', 'budget')
            ->when($this->selectedVisitType, function ($query) {
                $query->where('visit_type_id', $this->selectedVisitType);
            })
            ->when($this->selectedStatus, function ($query) {
                $query->where('status', $this->selectedStatus);
            })
            ->when($this->selectedUser, function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('user_id', $this->selectedUser);
                });
            })
            ->when($this->selectedService, function ($query) {
                $query->whereHas('services', function ($query) {
                    $query->where('service_id', $this->selectedService);
                });
            })
            ->paginate($this->perPage);

           
        return view(
            'livewire.panel.property.show-property',
            [
                'visits' => $visits,
                'phones' => $mergePhones,
            ]
        )
            ->layout('layouts.panel');
    }
}
