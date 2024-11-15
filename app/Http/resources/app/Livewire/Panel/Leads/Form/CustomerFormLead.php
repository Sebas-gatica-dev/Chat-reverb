<?php

namespace App\Livewire\Panel\Leads\Form;

use App\Enums\GenderEnum;
use App\Enums\SourceEnum;
use App\Enums\TypeContactEnum;
use App\Livewire\Components\SelectGeneral;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\LeadActivity;
use App\Models\Service;
use App\Models\User;
use App\Traits\RedirectItemToPageTrait;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class CustomerFormLead extends Component
{
    use RedirectItemToPageTrait;

    public $idModel = 'customer-form-lead';
    public $sources;
    public $type_contacts;
    public $services;
    public $branches;
    public $users;
    public $genders;
    public $selectedSource;
    public $selectedGender;
    public $selectedTypeContact;
    public $selectedService;
    public $description;

    public array $data = [];

    public $selectedUser;

    public function getListeners()
    {
        return [
            "update-selected-value-live-{$this->idModel}" => 'updatedData',
        ];
    }


    public function rules()
    {
        return [
            'data.date_lead' => 'nullable|date',
            'data.time_lead' => 'nullable|date_format:H:i',
            'data.type_contact' => ['required', Rule::in(array_column(TypeContactEnum::cases(), 'value'))],

            'data.name' => 'nullable|min:3|max:75',
            'data.surname' => 'nullable|min:3|max:75',
            'data.business_name' => 'nullable|min:3|max:75',

            'data.gender' =>  ['nullable', Rule::in(array_column(GenderEnum::cases(), 'value'))],
            'data.email' => 'nullable|required_if:data.type_contact,email|email|max:255',
            'data.phone' => 'nullable|required_if:data.type_contact,phone_call,whatsapp|string|max:255',

            'data.service_id' => 'nullable',
            'data.source' => ['nullable', Rule::in(array_column(SourceEnum::cases(), 'value'))],
            'data.created_by' => 'required|exists:users,id',

            'data.description' => 'nullable|string|max:255',
        ];
    }



    public function mount()
    {




        $this->sources = collect(SourceEnum::cases())->map(function ($source) {
            return [
                'id' => $source->value,
                'name' => $source->getName()
            ];
        })->toArray();

        $this->type_contacts = collect(TypeContactEnum::cases())->map(function ($type_contact) {
            return [
                'id' => $type_contact->value,
                'name' => $type_contact->getName()
            ];
        })->toArray();

        $this->genders = collect(GenderEnum::cases())->map(function ($gender) {
            return [
                'id' => $gender->value,
                'name' => $gender->getName()
            ];
        })->toArray();

        $this->services = Service::where('business_id', auth()->user()->business_id)->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name
            ];
        })->toArray();

        $this->users = User::where('business_id', auth()->user()->business_id)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name
            ];
        })->toArray();

        $this->selectedGender = $this->data['gender'] ?? null;
        $this->selectedSource = $this->data['source'] ?? null;
        $this->selectedTypeContact = $this->data['type_contact'] ?? null;
        $this->selectedUser = $this->data['created_by'] ?? auth()->user()->id;
        //  dd($this->data);
        if (
            isset($this->data['id']) && is_null($this->data['lead_first_activity'])
            || !isset($this->data['lead_first_activity'])
        ) {

            $this->data['lead_first_activity']['comment'] = null;
        }
        // dd($this->data);
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
        $this->data[$field] = $value;
        if (isset($this->data['id'])) {

            if (!$this->isNotRelation($field)) {
                // Guardar el campo modificado en la base de datos
                Customer::where('id', $this->data['id'])->update([
                    $field => $value
                ]);
            }
            
            $this->dispatch('updateDataLeadAndStep', step: 1);
        }


        
    }


    public function isNotRelation($field)
    {

        if ($field == 'lead_first_activity.comment') {

            $leadActivity = LeadActivity::updateOrCreate(
                ['customer_id' => $this->data['id'],  'is_initial' => true],
                [
                    'comment' => $this->data['lead_first_activity.comment'],
                    'type_contact' => $this->data['type_contact'],
                    'user_id' => $this->data['created_by'],
                    'date' => $this->data['date_lead'],
                    'time' => $this->data['time_lead'],
                ]
            );

            return true;
        }

        return false;
    }



    public function saveFormNewLead()
    {




        $this->validate();

        $customer = Customer::create([
            'date_lead' => $this->data['date_lead'],
            'time_lead' => $this->data['time_lead'],
            'type_contact' => $this->data['type_contact'],
            'name' => $this->data['name'],
            'surname' => $this->data['surname'],
            'business_name' => $this->data['business_name'],
            'gender' => $this->data['gender'],
            'email' => $this->data['email'],
            'source' => $this->data['source'],
            //services
            'created_by' => $this->data['created_by'],
            'business_id' => auth()->user()->business_id,
        ]);




        $lead_activity = $customer->leadActivities()->create([
            'customer_id' => $customer->id,
            'user_id' => $this->data['created_by'],
            'date' => $this->data['date_lead'],
            'time' => $this->data['time_lead'],
            'type_contact' => $this->data['type_contact'],
            'comment' => $this->data['lead_first_activity.comment'] ?? null,
            'is_initial' => true,
        ]);


        $property = $customer->properties()->create([
            'created_by' => $this->data['created_by'],
            'business_id' => auth()->user()->business_id,
            'property_name' => 'Principal',
        ]);


        if ($this->data['phone']) {
            $phone = $customer->phones()->create([
                'number' => $this->data['phone'],
                'tag' => 'Principal',
                'order' => 1,
                'type' => 1,
            ]);
        }

        // return $this->redirectToCustomerPage($customer->id);
        $this->redirectRoute('panel.leads.add', $customer->id, true);
    }


    public function placeholder()
    {
        return <<<'HTML'
         <div class="col-span-12 bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg">
                        <div class="border border-purple-100 shadow-md rounded-md p-4 w-full mx-auto">
                            <div class="animate-pulse flex space-x-4">
                              <div class="rounded-full bg-purple-100 h-10 w-10"></div>
                              <div class="flex-1 space-y-6 py-1">
                                <div class="h-2 bg-purple-100 rounded"></div>
                                <div class="space-y-3">
                                  <div class="grid grid-cols-3 gap-4">
                                    <div class="h-2 bg-purple-100 rounded col-span-2"></div>
                                    <div class="h-2 bg-purple-100 rounded col-span-1"></div>
                                  </div>
                                  <div class="h-2 bg-purple-100 rounded"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
        HTML;
    }


    public function render()
    {
        return view('livewire.panel.leads.form.customer-form-lead');
    }
}
