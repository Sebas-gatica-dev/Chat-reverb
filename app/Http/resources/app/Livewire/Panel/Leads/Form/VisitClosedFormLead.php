<?php

namespace App\Livewire\Panel\Leads\Form;

use App\Enums\PaymentMethodEnum;
use App\Enums\StatusCustomerEnum;
use App\Helpers\Notifications;
use App\Models\Customer;
use App\Models\Visit;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Isolate;

#[Isolate]
class VisitClosedFormLead extends Component
{


    public $idModel = 'visit-closed-form-lead';
    public $coordinateLater = false;
    public $recommendedDate = false;

    public array $data = [];

    public $selectedUsers = [];
    public $selectedServices = [];
    public $selectedTypeVisit = [];
    public $users;
    public $typeVisits;
    public $services;
    public $expectedPayments;
    public $checked = false;
    public $answer;
    public $selectedExpectedPayment;
    public $date;
    public $time;
    public $price;
    public $created_by;
    public $message;
    public $property;


    public $selectedBudget = null;


    public function getListeners()
    {
        return [
            "update-selected-value-live-{$this->idModel}" => 'updatedData',
            "update-selected-values-{$this->idModel}" => 'updateDataMultiple',
            "update-search-{$this->idModel}-data.workers" => 'searchUser',
            "update-search-{$this->idModel}-data.types_services" => 'searchTypeServices',
        ];
    }

    public function rules()
    {
        return [
            'data.date' => 'required|date',
            'data.time' => 'required|date_format:H:i',
            'data.workers' => 'required|array',
            'data.types_visit' => 'required',
            'data.types_services' => 'required|array',
            'data.iva' => 'required|boolean',
            'data.price' => 'required|numeric',
            'data.expected_payment' => 'required',
            'data.created_by' => 'required',
            'data.message' => 'required|min:3|max:20000',
            'data.duration_time' => 'required|numeric',
        ];
    }


    public function messages()
    {

        return [


            'data.price.numeric' => 'El precio debe ser un número',
            'data.price.required' => 'El precio es obligatorio',
            'data.date.required' => 'La fecha es obligatoria',
            'data.date.date' => 'La fecha no es válida',
            'data.time.required' => 'La hora es obligatoria',
            'data.time.date_format' => 'La hora no es válida',
            'data.workers.required' => 'Debes seleccionar al menos un operario',
            'data.types_visit.required' => 'Debes seleccionar un tipo de visita',
            'data.types_services.required' => 'Debes seleccionar al menos un servicio',
            'data.iva.required' => 'Debes seleccionar si el precio incluye IVA',
            'data.iva.boolean' => 'El valor de IVA no es válido',
            'data.expected_payment.required' => 'Debes seleccionar un método de pago',
            'data.created_by.required' => 'Debes seleccionar un usuario',
            'data.message.required' => 'El mensaje es obligatorio',
            'data.message.min' => 'El mensaje debe tener al menos 3 caracteres',
            'data.message.max' => 'El mensaje no puede tener más de 20000 caracteres',
            'data.duration_time.required' => 'Debes seleccionar la duración de la visita',
            'data.duration_time.numeric' => 'La duración de la visita debe ser un número',
            


        ];
    }

    public function mount()
    {


        $this->prepareForCreation();

        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });


        $this->typeVisits = auth()->user()->business->visitsTypes()->get()->map(function ($typeVisit) {
            return [
                'id' => $typeVisit->id,
                'name' => $typeVisit->name,
            ];
        })->toArray();

        $this->services = auth()->user()->business->services()->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });


        //Enum PaymentMethodEnums
        $this->expectedPayments = collect(PaymentMethodEnum::cases())->map(function ($paymentEnum) {
            return [
                'id' => $paymentEnum->value,
                'name' => $paymentEnum->getName(),
            ];
        })->toArray();


        if($this->property['budget']){

            $this->data['price'] = $this->property['budget']['total'];
            
            if($this->property['budget']['iva']){
                $this->data['iva'] = true;
            }

            


        }

    }


    public function prepareForCreation()
    {

        $this->data['date'] = null;
        $this->data['time'] = null;
        $this->data['workers'] = [];
        $this->data['types_visit'] = null;
        $this->data['types_services'] = [];
        $this->data['iva'] = false;
        $this->data['price'] = null;
        $this->data['expected_payment'] = null;
        $this->data['created_by'] = null;
        $this->data['message'] = null;
        $this->data['duration_time'] = null;
    }



    #[On('update-checked-data.iva')]
    public function updateCheckedIva($value)
    {
        $this->data['iva'] = $value;
    }


    public function updatedData($value, $input)
    {

        if (is_array($value) && count($value) > 0) $value = $value['id'];

        $this->validateOnly('data.' . $input);

        $input = str_replace('data.', '', $input);

        $this->data[$input] = $value;


        // efecto de carga, que dure
        $this->dispatch('data.' . $input);
    }


    public function updateDataMultiple($value, $input)
    {


        $this->validateOnly('data.' . $input);
        $input = str_replace('data.', '', $input);
        $this->data[$input] = $value;

    }


    public function createVisit()
    {

        
        $this->validate();


        $visit = Visit::create([
            'date' => $this->data['date'],
            'time' => $this->data['time'],
            'price' => $this->data['price'],
            'iva' => $this->data['iva'],
            'status' => 0,
            'expected_payment' => $this->data['expected_payment'],
            'visit_type_id' => $this->data['types_visit'],
            'property_id' => $this->property['id'],
            'customer_id' => $this->property['customer_id'],
            'created_by' => $this->data['created_by'],
            'duration_time' => $this->data['duration_time'],
            'business_id' => auth()->user()->business->id,
        ]);

        //Agregamos los servicios a la visita
        $visit->services()->sync($this->data['types_services']);

        //Agregamos el comentario a la visita
        $comment =  $visit->comments()->create([
            'message' => $this->data['message'],
            'user_id' => auth()->id(),
        ]);

        
        //Agregamos los operarios a la visita
        $visit->users()->attach($this->data['workers']);

        session()->flash('notification', [
            'message' => 'Visita creada correctamente',
            'type' => Notifications::icons('success')
        ]);


        //Cerramos el cliente
        $customer = Customer::where('id', $this->property['customer_id'])->first();
        $customer->status = StatusCustomerEnum::CLOSED->value;
        $customer->save();

        //Redirigimos a la propiedad
        $this->redirectRoute('panel.customers.property.show', [$customer, $this->property['id']], true, true);
    }


    public function searchUser($search)
    {
        $values = auth()->user()->business->users()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo
                ];
            });

        $this->dispatch("update-values-{$this->idModel}-component-data.workers", $values);
    }

    public function searchTypeServices($search)
    {
        $values = auth()->user()->business->services()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->get()->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                ];
            });

        $this->dispatch("update-values-{$this->idModel}-component-data.types_services", $values);
    }


    #[Computed()]
    public function totalPrice()
    {
        $price = $this->data['price'] ?? 0;
        $iva = $this->data['iva'];
     
        if ($iva && $price > 0) {
            return $price + ($price * 0.21);
        } else {
            return $price;
        }
    }

    public function render()
    {
        return view('livewire.panel.leads.form.visit-closed-form-lead');
    }
}
