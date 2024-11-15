<?php

namespace App\Livewire\Panel\Leads\Form;

use App\Enums\PaymentMethodEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
use App\Models\Customer;
use App\Models\Visit;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class VisitInspectFormLead extends Component
{


    public $coordinateLater = false;
    public $recommendedDate = false;
    public $selectedUsers = [];
    public $selectedServices = [];
    public $selectedTypeVisit = [];
    // public $users;
    public $typeVisits;
    public $services;
    public $expectedPayments;
    public $checked;
    public $answer;
    public $selectedExpectedPayment;
    public $date;
    public $time;
    public $price;
    public $message;
    public $data;
    public $idModel = 'visit-inspect-form-lead';
    public $property;
    public $visit;
    public $users;


    public function getListeners()
    {
        return [
            "update-selected-value-live-{$this->idModel}" => 'updatedData',
            "update-selected-values-{$this->idModel}" => 'updateDataMultiple',
            "update-search-{$this->idModel}-data.workers" => 'searchUser',
            "update-search-{$this->idModel}-data.expected_payment" => 'searchExpectedPayment',
        ];
    }

    public function mount()
    {


        if ($this->visit) {
            $this->data =  [
                'date' => $this->visit->date,
                'time' => $this->visit->time,
                'workers' => [],
                'price' => $this->visit->price,
                'iva' => $this->visit->iva,
                'duration_time' => $this->visit->duration_time,
                'expected_payment' => $this->visit->expected_payment,
                'comment' => $this->visit->comments,
                'created_by' => auth()->user()->id,
            ];
        } else {
            $this->data =
                [
                    'date' => null,
                    'time' => null,
                    'workers' => [],
                    'price' => null,
                    'iva' => false,
                    'duration_time' => null,
                    'expected_payment' => null,
                    'comment' => null,
                    'created_by' => auth()->user()->id,
                ];
        }



        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });



        //Enum PaymentMethodEnums
        $this->expectedPayments = collect(PaymentMethodEnum::cases())->map(function ($paymentEnum) {
            return [
                'id' => $paymentEnum->value,
                'name' => $paymentEnum->getName(),
            ];
        })->toArray();

        $this->selectedExpectedPayment = $this->data['payment_expected'] ?? null;
    }



    public function rules()
    {
        return [
            'data.date' => 'required|date',
            'data.time' => 'required|date_format:H:i',
            // 'data.users' => 'required|array|min:1|exists:users,id',
            'data.price' => 'nullable|numeric|min:0',
            'data.iva' => 'nullable|boolean',
            'data.expected_payment' => ['nullable', Rule::in(array_column(PaymentMethodEnum::cases(), 'value'))],
            'data.comment' => 'required|min:3|max:20000',
        ];
    }



    #[On('update-checked-iva')]
    public function changeChecked($value)
    {

        $this->updatedData($value, 'data.iva');
    }





    public function updatedData($value, $input)
    {

        // Validar solo el campo que cambió (por ejemplo "data.name")
        $this->validateOnly('data.' . $input);

        // Guardar solo el campo que cambió
        $this->saveField($value, $input);

        // efecto de carga, que dure
        $this->dispatch('data.' . $input);
    }


    public function saveField($value, $input)
    {


        // Extraer el nombre del campo (ej. "name" en vez de "data.name")
        $field = str_replace('data.', '', $input);

        if (isset($this->visit)) {
            // Guardar el campo modificado en la base de datos
            $this->visit->$field = $value;
            $this->visit->save();
        }

        $this->data[$field] = $value;

        $this->dispatch('updateDataLeadAndStep', step: 1);
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



    public function searchExpectedPayment($search)
    {

        $values = collect(PaymentMethodEnum::cases())
            ->filter(function ($paymentEnum) use ($search) {
                // Si no hay búsqueda, devuelve todos
                if (is_null($search)) {
                    return true;
                }
                // Filtra por nombre
                return stripos($paymentEnum->getName(), $search) !== false;
            })
            ->map(function ($paymentEnum) {
                return [
                    'id' => $paymentEnum->value,
                    'name' => $paymentEnum->getName(),
                ];
            })->toArray();

        $this->dispatch('update-values-data.expected_payment', $values);
    }


    public function updateDataMultiple($value, $input)
    {

        $this->validateOnly('data.' . $input);
        $input = str_replace('data.', '', $input);
        $this->data[$input] = $value;
    }



    public function saveFormNewVisitInspect()
    {

        $this->validate();

        $this->visit = Visit::create([
            'date' => $this->data['date'],
            'time' => $this->data['time'],
            'price' => $this->data['price'],
            'iva' => $this->data['iva'],
            'expected_payment' => $this->data['expected_payment'],
            'duration_time' => $this->data['duration_time'],
            'inspect_visit' => true,
            'customer_id' => $this->property['customer_id'],
            'property_id' => $this->property['id'],
            'created_by' => $this->data['created_by'],
            'business_id' => auth()->user()->business_id,
        ]);



        $this->visit->users()->attach($this->data['workers']);


        $this->visit->services()->sync($this->data['types_services']);


        $comment =  $this->visit->comments()->create([
            'message' => $this->data['message'],
            'user_id' => auth()->id(),
        ]);

        $customer = Customer::where('id', $this->property['customer_id'])->first();
        $customer->status = StatusCustomerEnum::TO_VISIT->value;
        $customer->save();
        $this->visit->refresh();
        $this->dispatch('update-status');
     

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
        return view('livewire.panel.leads.form.visit-inspect-form-lead');
    }
}
