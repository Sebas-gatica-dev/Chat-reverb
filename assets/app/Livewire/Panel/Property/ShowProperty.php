<?php

namespace App\Livewire\Panel\Property;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Phone;
use App\Models\Property;
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
            'created_at'
        ])->where('id', $this->customer)->with([
            'createdBy' => fn($query) => $query->select(['id', 'name']),
            'phones' => fn($query) => $query->select(['id', 'number', 'tag', 'type', 'order', 'phoneable_id', 'phoneable_type']),
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
            'visits.users' => fn($query) => $query->select(['id', 'name']),
            'visits.services' => fn($query) => $query->select(['id', 'name']),
            'city' => fn($query) => $query->select(['id', 'name']),
            'neighborhood' => fn($query) => $query->select(['id', 'name']),
            'propertyType' => fn($query) => $query->select(['id', 'name']),
        ])->firstOrFail();

        // dd( $this->property);




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


    public function render()
    {



        $phonesCustomer = $this->customer->phones->toArray();
        $phonesProperty = $this->property->phones->toArray();



        $mergePhones = array_merge($phonesCustomer, $phonesProperty);

        usort($mergePhones, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });


        $visits = $this->property->visits()
            ->when($this->selectedVisitType, function ($query) {
                $query->where('visit_type_id', $this->selectedVisitType['id']);
            })
            ->when($this->selectedStatus, function ($query) {
                $query->where('status', $this->selectedStatus['id']);
            })
            ->when($this->selectedUser, function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('user_id', $this->selectedUser['id']);
                });
            })
            ->when($this->selectedService, function ($query) {
                $query->whereHas('services', function ($query) {
                    $query->where('service_id', $this->selectedService['id']);
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
