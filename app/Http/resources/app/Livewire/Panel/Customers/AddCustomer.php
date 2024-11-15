<?php

namespace App\Livewire\Panel\Customers;

use App\Enums\Forms\SectorTypeEnum;
use App\Enums\Source;
use App\Enums\SourceEnum;
use App\Helpers\Notifications;
use App\Mail\Customer\AddCustomerMail;
use App\Models\Customer;
use App\Models\Input;
use App\Models\User;
use App\Rules\UniqueWithinBusiness;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Traits\ValidateNotificationTrait;
use App\Rules\FormDynamicRequired;




class AddCustomer extends Component
{
    use ValidateNotificationTrait;

    public $name;
    public $surname;
    public $business_name;
    public $gender;
    public $source;
    public $email;
    public $created_by;
    public $users;

    public $sources;

    public $formsDynamic = [];


    public function mount()
    {
        $this->authorize('access-function', 'customer-add');
        $this->users = User::all();
        $this->created_by = auth()->id();
        $this->sources = SourceEnum::cases();


        $this->formsDynamic = Input::where('business_id', auth()->user()->business_id)
        ->where('sector', SectorTypeEnum::Customner->value)
        ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
        ->orderBy('order', 'asc') // Ordenar por el campo 'order'
        ->get()
        ->mapWithKeys(function ($input) {
            return [
                $input->id => [
                    'label' => $input->label,
                    'input_type' => $input->input_type,
                    'placeholder' => $input->placeholder,
                    'required' => $input->required,
                    'options' => $input->options,
                    'value' => null,
                ],
            ];
        })->toArray();

        
    }

    
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'gender' => 'required|string|in:male,female',
            'source' => ['required', Rule::enum(SourceEnum::class)],
            'email' => ['required', 'email', new UniqueWithinBusiness(Customer::class, 'email')],
            'created_by' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'gender.required' => 'El género es obligatorio.',
            'source.required' => 'La fuente es obligatoria.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'created_by.required' => 'El campo "Cerrado por" es obligatorio.',
        ];
    }




    public function save()
    {

        $this->validate();

        $customer = Customer::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'business_name' => $this->business_name,
            'gender' => $this->gender,
            'source' => $this->source,
            'email' => $this->email,
            'created_by' =>  $this->created_by,
            'business_id' => auth()->user()->business_id
        ]);


        Mail::to($this->email)->queue(new AddCustomerMail($customer));

        session()->flash('notification', [
            'message' => 'Cliente creado correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.customers.property.add', ['customer' => $customer->id]);
        
    }



    public function render()
    {
        return view('livewire.panel.customers.add-customer')
            ->layout('layouts.panel');
    }
}
