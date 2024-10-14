<?php

namespace App\Livewire\Panel\Property;

use App\Enums\FrequencyEnum;
use App\Enums\SourceEnum;
use App\Helpers\Notifications;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use App\Rules\UniqueWithinBusiness;
use App\Rules\ValidCuitOrDni;
use App\Rules\ValidSubzone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use App\Jobs\ImageOptimizationSquare;
use App\Traits\ValidateNotificationTrait;
use Illuminate\Support\Facades\Gate;

class EditProperty extends Component
{
    use WithFileUploads, ValidateNotificationTrait;
    public $customer;
    public $property;
    public $users;
    public $branches;
    public $propertiesTypes;
    public $provinces;
    public $cities = [];
    public $neighborhoods = [];
    public $subzones = [];
    public $latitude;
    public $longitude;
    public $property_name;
    public $property_type;
    public $frequency;
    public $documentation;
    public $branch_id;
    public $created_by;
    public $address;
    public $between_streets;
    public $floor;
    public $apartment;
    public $province_id;
    public $city_id;
    public $neighborhood_id;
    public $subzone_id;
    public $photo = [];
    public $business;
    public $name;
    public $surname;
    public $email;
    public $business_name;
    public $gender;
    public $source;
    public $customer_createdby;
    public $sources;
    public $frequencies;

    public $availabilities = [];

    public $newPhoto;

    public function mount()
    {

        $this->authorize('access-function', 'customer-edit');
        $this->authorize('access-function', 'property-edit');






        $this->business = auth()->user()->business()->select(['id', 'name'])->with([
            'provinces' => fn($query) => $query->select(['id', 'province_id', 'provinceable_id'])->with('province', fn($query) => $query->select(['id', 'name'])),
            'cities' => fn($query) => $query->select(['id', 'city_id', 'citiable_id']),
            'neighborhoods' => fn($query) => $query->select(['id', 'neighborhood_id', 'neighborable_id']),
            'subzones' => fn($query) => $query->select(['id', 'subzone_id', 'subzonable_id']),
            'branches' => fn($query) => $query->select(['id', 'name', 'address', 'latitude', 'longitude', 'business_id', 'created_by'])->whereHas('users', fn($query) => $query->where('user_id', auth()->id())),
            'users' => fn($query) => $query->select(['id', 'name', 'photo as image', 'business_id']),
            'propertiesTypes' => fn($query) => $query->select(['id', 'name', 'business_id']),
        ])->firstOrFail();

        $this->property = Property::select([
            'id',
            'property_name',
            'branch_id',
            'property_type',
            'photo',
            'frequency',
            'created_by',
            'address',
            'between_streets',
            'floor',
            'apartment',
            'province_id',
            'city_id',
            'neighborhood_id',
            'subzone_id',
            'latitude',
            'longitude',
            'documentation'
        ])->where('id', $this->property)->with([
            'customer' => fn($query) => $query->select(['id', 'name', 'surname', 'email', 'business_name', 'gender', 'source', 'created_by']),
            'phones' => fn($query) => $query->select(['id', 'number', 'tag', 'type', 'order', 'phoneable_id', 'phoneable_type']),
            'createdBy' => fn($query) => $query->select(['id', 'name']),
            'propertyType' => fn($query) => $query->select(['id', 'name']),
            'country' => fn($query) => $query->select(['id', 'name']),
            'province' => fn($query) => $query->select(['id', 'name']),
            'city' => fn($query) => $query->select(['id', 'name']),
            'neighborhood' => fn($query) => $query->select(['id', 'name']),
            'subzone' => fn($query) => $query->select(['id', 'name']),
            'visits' => fn($query) => $query->select(['id', 'property_id', 'visit_type_id', 'status', 'date', 'time', 'duration_time']),
            'availabilities' => fn($query) => $query->select(['id', 'day', 'start', 'end', 'availabilitable_id', 'availabilitable_type']),
        ])->firstOrFail();

        $this->customer = Customer::select([
            'id',
            'name',
            'surname',
            'email',
            'business_name',
            'gender',
            'source',
            'created_by'
        ])->where('id', $this->customer)->firstOrFail();

        $this->users = $this->business->users;
        $this->branches = $this->business->branches;
        $this->propertiesTypes = $this->business->propertiesTypes;
        $this->provinces = $this->business->provinces;
        $this->property_name = $this->property->property_name;
        $this->documentation = $this->property->documentation;
        $this->branch_id = $this->property->branch_id;
        $this->property_type = $this->property->property_type;
        $this->photo[] = $this->property->photo;
        $this->frequency = $this->property->frequency;
        $this->created_by = $this->property->created_by;
        $this->address = $this->property->address;
        $this->between_streets = $this->property->between_streets;
        $this->floor = $this->property->floor;
        $this->apartment = $this->property->apartment;
        $this->province_id = $this->property->province_id;
        $this->city_id = $this->property->city_id;
        $this->neighborhood_id = $this->property->neighborhood_id;
        $this->subzone_id = $this->property->subzone_id;
        $this->latitude = $this->property->latitude;
        $this->longitude = $this->property->longitude;

        // $this->cities = $this->business->cities->where('province_id', $this->province_id);
        // $this->neighborhoods = $this->business->neighborhoods->where('city_id', $this->city_id);
        // $this->subzones = $this->business->subzones->where('neighborhood_id', $this->neighborhood_id)->isEmpty()
        //     ? [] : $this->business->subzones->where('neighborhood_id', $this->neighborhood_id);

        $this->cities = $this->business->cities;
        $this->neighborhoods = $this->business->neighborhoods;
        $this->subzones = $this->business->subzones->isEmpty()
            ? [] : $this->business->subzones;

        //customer

        $this->name = $this->customer->name;
        $this->surname = $this->customer->surname;
        $this->email = $this->customer->email;
        $this->business_name = $this->customer->business_name;
        $this->gender = $this->customer->gender;
        $this->source = $this->customer->source;
        $this->customer_createdby = $this->customer->created_by;
        $this->sources = SourceEnum::cases();
        $this->frequencies = FrequencyEnum::cases();

        // Fetching availabilities
        $this->availabilities = $this->property->availabilities->map(function ($availability) {
            return [
                'id' => $availability->id,
                'day' => $availability->day->value, // Convert enum to value
                'start_time' => substr($availability->start, 0, 5),
                'end_time' => substr($availability->end, 0, 5),
            ];
        })->toArray();
    }

    #[On('updateLatLong')]
    public function updateLatLong($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    #[On('updateAddress')]
    public function updateAddress($address)
    {
        $this->address = $address;
    }

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
    public function rules()
    {
        return [
            'property_name' => 'required|string|max:75',
            'property_type' => 'required|exists:property_types,id',
            'documentation' => ['nullable', 'string', new ValidCuitOrDni],
            'frequency' => ['required', Rule::enum(FrequencyEnum::class)],
            'branch_id' => 'required|exists:branches,id',
            'created_by' => 'required|exists:users,id',
            'address' => 'required|string|max:75',
            'between_streets' => 'required|string|max:75',
            'floor' => 'nullable|string|max:20',
            'apartment' => 'nullable|string|max:20',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'neighborhood_id' => 'required|exists:neighborhoods,id',
            'subzone_id' => 'nullable|exists:subzones,id',
            'name' => 'required|string|max:75',
            'surname' => 'nullable|string|max:75',
            'business_name' => 'nullable|string|max:75',
            'gender' => 'required|string|in:male,female',
            'source' => ['required', Rule::enum(SourceEnum::class)],
            'email' => ['required', 'email', new UniqueWithinBusiness(Customer::class, 'email', $this->customer->id)],
            'customer_createdby' => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            // property_name
            'property_name.required' => 'El nombre de la propiedad es obligatorio.',
            'property_name.max' => 'Has superado el límite de caracteres.',
            'property_name.string' => 'El nombre debe ser un texto.',

            // property_type
            'property_type.required' => 'El tipo de propiedad es obligatorio.',
            'property_type.exists' => 'El tipo de propiedad seleccionado no es válido.',

            // documentation
            'documentation.ValidCuitOrDni' => 'El documento debe ser un CUIT o DNI válido.',

            // frequency
            'frequency.required' => 'La frecuencia es obligatoria.',

            // branch_id
            'branch_id.required' => 'La sucursal es obligatoria.',
            'branch_id.exists' => 'La sucursal seleccionada no es válida.',

            // created_by
            'created_by.required' => 'El campo "Cerrado por" es obligatorio.',
            'created_by.exists' => 'El usuario que cerró no es válido.',

            // address
            'address.required' => 'La dirección es obligatoria.',
            'address.string' => 'La dirección debe ser un texto.',
            'address.max' => 'Has superado el límite de caracteres para la dirección.',

            // between_streets
            'between_streets.required' => 'Las entrecalles son obligatorias.',
            'between_streets.string' => 'Las entrecalles deben ser texto.',
            'between_streets.max' => 'Has superado el límite de caracteres para las entrecalles.',

            // floor
            'floor.string' => 'El piso debe ser un texto.',
            'floor.max' => 'Has superado el límite de caracteres para el piso.',

            // apartment
            'apartment.string' => 'El departamento debe ser un texto.',
            'apartment.max' => 'Has superado el límite de caracteres para el departamento.',

            // province_id
            'province_id.required' => 'La provincia es obligatoria.',
            'province_id.exists' => 'La provincia seleccionada no es válida.',

            // city_id
            'city_id.required' => 'La ciudad es obligatoria.',
            'city_id.exists' => 'La ciudad seleccionada no es válida.',

            // neighborhood_id
            'neighborhood_id.required' => 'El barrio es obligatorio.',
            'neighborhood_id.exists' => 'El barrio seleccionado no es válido.',

            // subzone_id
            'subzone_id.exists' => 'La subzona seleccionada no es válida.',

            // name
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'Has superado el límite de caracteres para el nombre.',

            // surname
            'surname.string' => 'El apellido debe ser un texto.',
            'surname.max' => 'Has superado el límite de caracteres para el apellido.',

            // business_name
            'business_name.string' => 'El nombre comercial debe ser un texto.',
            'business_name.max' => 'Has superado el límite de caracteres para el nombre comercial.',

            // gender
            'gender.required' => 'El género es obligatorio.',
            'gender.in' => 'El género es obligatorio.',

            // source
            'source.required' => 'La fuente es obligatoria.',
            'source.enum' => 'La fuente es obligatoria.',

            // email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',

            // customer_createdby
            'customer_createdby.required' => 'Selecciona quién cerró el cliente.',
            'customer_createdby.exists' => 'El usuario seleccionado no es válido.'
        ];
    }



    public function save()
    {

        $this->validate();

        $this->property->update([
            'property_name' => $this->property_name,
            'property_type' => $this->property_type,
            'documentation' => $this->documentation,
            'frequency' => $this->frequency,
            'branch_id' => $this->branch_id,
            'created_by' => $this->created_by,
            'address' => $this->address,
            'between_streets' => $this->between_streets,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'neighborhood_id' => $this->neighborhood_id,
            'subzone_id' => $this->subzone_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->customer->update([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'business_name' => $this->business_name,
            'gender' => $this->gender,
            'source' => $this->source,
            'created_by' => $this->customer_createdby,
        ]);

        // Delete existing availabilities
        $this->property->availabilities()->delete();

        // Create new availabilities
        foreach ($this->availabilities as $availability) {
            $this->property->availabilities()->create([
                'day' => $availability['day'],
                'start' => $availability['start_time'],
                'end' => $availability['end_time']
            ]);
        }

        if (($this->photo == null && $this->property->photo)) {
            if ($this->property->photo != 'https://placehold.co/400') { //CHAU PRODUCCION
                Storage::delete($this->property->getRawOriginal('photo'));
            }
            $this->property->update([
                'photo' => null
            ]);
        }

        if ($this->authorize('access-function', 'property-add-photo') && $this->newPhoto) {

            // Borrar la imagen anterior

            if ($this->property->photo != 'https://placehold.co/400') {
                Storage::delete($this->property->getRawOriginal('photo'));
            }

            $filename =   uniqid() . '.webp';
            $filePath = Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/';
            $filenameComplete = $filePath . $filename;

            $this->newPhoto->storeAs(path: $filePath, name: $filename);

            $this->property->update([
                'photo' => $filenameComplete
            ]);

            Bus::dispatch(new ImageOptimizationSquare($filenameComplete));
        }

        session()->flash('notification', [
            'message' => 'Propiedad actualizada correctamente.',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->customer->id, $this->property->id]);
    }


    #[On('change-files-property-photo')]
    public function changePhoto($value)
    {

        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
        $this->newPhoto = $file;
    }

    #[On('remove-files-property-photo')]
    public function removeFile()
    {

        $this->photo = null;
    }

    #[On('remove-files-existing-property-photo')]
    public function removePhotoExisting()
    {
        $this->photo = null;
    }

    #[On('updateAvailabilities')]
    public function updateAvailability($availabilities)
    {

        $this->availabilities = $availabilities;
    }


    //METODOS DE ACTUALIZACION DE LATITUD Y LONGITUD
    #[On('receive-start-lat')]
    public function updateLatitude($value)
    {
        $this->latitude = $value;
    }

    #[On('receive-start-long')]
    public function updateLongitude($value)
    {
        $this->longitude = $value;
    }


    //   #[On('updateAddress')]
    //   public function updateAddress($address)
    //   {
    //       $this->address = $address;
    //   }


    public function render()
    {
        return view('livewire.panel.property.edit-property')
            ->layout('layouts.panel', ['title' => 'Editar propiedad']);
    }
}
