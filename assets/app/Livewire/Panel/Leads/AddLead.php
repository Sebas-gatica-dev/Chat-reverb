<?php

namespace App\Livewire\Panel\Leads;

use App\Enums\SourcesEnum;
use App\Enums\StatusLedEnum;
use App\Enums\TypeContactEnum;
use App\Models\Branch;
use App\Models\Lead;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

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

    public function mount()
    {
        // Authorize the user if necessary (uncomment if you have authorization logic)
        // $this->authorize('access-function', 'lead-add');

        // Load enum cases
        $this->sources = SourcesEnum::cases();
        $this->type_contacts = TypeContactEnum::cases();
        $this->statuses = StatusLedEnum::cases();

        // Set default status
        $this->status = StatusLedEnum::IN_PROCESS->value;

        // Load models
        $this->property_types = PropertyType::where('business_id', auth()->user()->business_id)->get();
        $this->services = Service::where('business_id', auth()->user()->business_id)->get();
        $this->branches = Branch::where('business_id', auth()->user()->business_id)->get();
        $this->users = User::where('business_id', auth()->user()->business_id)->get();
        $this->provinces = Province::whereIn('id', auth()->user()->business->provinces->pluck('province_id'))->get();

        // Set default values
        $this->created_by = auth()->id();
        $this->date = now()->format('Y-m-d');
        $this->time = now()->format('H:i');
    }



    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'email' => 'nullable|email|max:255',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => 'nullable|string|max:255',
            'source' => ['required', Rule::in(array_column(SourcesEnum::cases(), 'value'))],
            'type_contact' => ['required', Rule::in(array_column(TypeContactEnum::cases(), 'value'))],
            'status' => ['required', Rule::in(array_column(StatusLedEnum::cases(), 'value'))],
            'description' => 'nullable|string',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'neighborhood_id' => 'nullable|exists:neighborhoods,id',
            'subzone_id' => 'nullable|exists:subzones,id',
            'property_type_id' => 'nullable|exists:property_types,id',
            'service_id' => 'nullable|exists:services,id',
            'branch_id' => 'nullable|exists:branches,id',
            'created_by' => 'required|exists:users,id',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'date.required' => 'La fecha es obligatoria.',
            'time.required' => 'La hora es obligatoria.',
            'gender.required' => 'El género es obligatorio.',
            'source.required' => 'La fuente es obligatoria.',
            'type_contact.required' => 'El tipo de contacto es obligatorio.',
            'created_by.required' => 'El campo "Creado por" es obligatorio.',
        ];
    }



    // Dynamic Updates
    public function updatingProvinceId($value)
    {
        $this->cities = auth()->user()->business->cities->where('city.province_id', $value);
        $this->reset(['city_id', 'neighborhood_id', 'subzone_id']);
    }

    public function updatingCityId($value)
    {
        $this->neighborhoods = auth()->user()->business->neighborhoods->where('neighborhood.city_id', $value);
        $this->reset(['neighborhood_id', 'subzone_id']);
    }

    public function updatingNeighborhoodId($value)
    {
        $this->subzones = auth()->user()->business->subzones->where('subzone.neighborhood_id', $value);
        if (count($this->subzones) == 0) {
            $this->subzones = [];
        }
        $this->reset('subzone_id');
    }



    public function save()
    {
        $this->validate();

        $lead = Lead::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'date' => $this->date,
            'time' => $this->time,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'source' => $this->source,
            'type_contact' => $this->type_contact,
            'status' => $this->status,
            'description' => $this->description,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'neighborhood_id' => $this->neighborhood_id,
            'subzone_id' => $this->subzone_id,
            'property_type_id' => $this->property_type_id,
            'service_id' => $this->service_id,
            'branch_id' => $this->branch_id,
            'created_by' => $this->created_by,
            'business_id' => auth()->user()->business_id,
            'country_id' => 1, // Assuming '1' => 'Argentina'
        ]);

        session()->flash('notification', [
            'message' => 'Lead creado correctamente',
            'type' => 'success',
        ]);

        $this->redirectRoute('panel.leads.list');
    }


    public function render()
    {
        return view('livewire.panel.leads.add-lead')
            ->layout('layouts.panel', ['title' => 'Leads']);
    }
}
