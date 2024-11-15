<?php

namespace App\Livewire\Panel\Property;

use App\Enums\AvailabilityDayEnums;
use App\Enums\FrequencyEnum;
use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationSquare;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\User;
use App\Rules\ValidCuitOrDni;
use App\Rules\ValidSubzone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Traits\ValidateNotificationTrait;

class AddProperty extends Component
{
    use WithFileUploads, ValidateNotificationTrait;

    // Properties
    public ?Customer $customer;
    public $users;
    public $branches;
    public $phones = [];
    public $property_name;
    public $property_type;
    public $documentation;
    public $frequency;
    public $branch_id;
    public $created_by;
    public $photo;
    public $address;
    public $between_streets;
    public $floor;
    public $apartment;
    public $province_id;
    public $city_id;
    public $neighborhood_id;
    public $subzone_id;
    public $number;
    public $tagNumber;
    public $typeNumber;
    public $phoneModel;
    public $propertiesTypes;
    public $provinces;
    public $cities = [];
    public $neighborhoods = [];
    public $subzones = [];
    public $latitude;
    public $longitude;
    public $frequencies;
    public $days;
    public $availabilities = [];

    // Lifecycle Hooks
    public function mount()
    {
        $this->authorize('access-function', 'property-add');

        $this->users = User::where('business_id', auth()->user()->business_id)->get();
        $this->branches = Auth::user()->business->branches()->whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
        $this->propertiesTypes = PropertyType::where('business_id', auth()->user()->business_id)->get();
        $this->provinces = Province::whereIn('id', auth()->user()->business->provinces->pluck('province_id'))->get();
        $this->frequencies = FrequencyEnum::cases();
        $this->created_by = auth()->id();
        $this->days = AvailabilityDayEnums::cases();
    }




      // Validation Rules
      protected function rules()
      {
          return [
              'property_name' => 'required|string|max:255',
              'property_type' => 'required|exists:property_types,id',
              'documentation' => ['nullable', 'string', new ValidCuitOrDni],
              'frequency' => ['required', Rule::enum(FrequencyEnum::class)],
              'branch_id' => 'required|exists:branches,id',
              'created_by' => 'required|exists:users,id',
              'address' => 'required|string|max:255',
              'between_streets' => 'required|string|max:255',
              'floor' => 'nullable|string|max:20',
              'apartment' => 'nullable|string|max:20',
              'province_id' => 'required|exists:provinces,id',
              'city_id' => 'required|exists:cities,id',
              'neighborhood_id' => 'required|exists:neighborhoods,id',
              'availabilities' => 'array|max:21',
              'subzone_id' => [new ValidSubzone($this->subzones)],
          ];
      }
  
      // Custom Validation Messages
      protected function messages()
      {
          return [
              'property_name.required' => 'El nombre de la propiedad es obligatorio.',
              'property_type.required' => 'El tipo de propiedad es obligatorio.',
              'property_type.exists' => 'El tipo de propiedad seleccionado no es válido.',
              'documentation.string' => 'La documentación debe ser una cadena de texto.',
              'frequency.required' => 'La frecuencia es obligatoria.',
              'branch_id.required' => 'La sucursal es obligatoria.',
              'created_by.required' => 'El creador es obligatorio.',
              'address.required' => 'La dirección es obligatoria.',
              'between_streets.required' => 'Las entrecalles de la propiedad son obligatorias.',
              'floor.string' => 'El piso debe ser una cadena de texto.',
              'apartment.string' => 'El apartamento debe ser una cadena de texto.',
              'province_id.required' => 'La provincia es obligatoria.',
              'city_id.required' => 'La ciudad es obligatoria.',
              'neighborhood_id.required' => 'El barrio es obligatorio.',
              'availabilities.array' => 'Las disponibilidades deben ser un arreglo.',
              'subzone_id.required' => 'La subzona es obligatoria.',
          ];
      }


    public function save()
    {


        $this->validate();

        $property = Property::create([
            'customer_id' => $this->customer->id,
            'business_id' => auth()->user()->business_id,
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
            'country_id' => 1, // '1' => 'Argentina'
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'neighborhood_id' => $this->neighborhood_id,
            'subzone_id' => $this->subzone_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ]);

        $this->saveAvailabilities($property);
        $this->savePhoto($property);
        $this->savePhones($property);

        session()->flash('notification', [
            'message' => 'Propiedad creada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.customers.show', $this->customer->id);
    }

    // Save Availabilities
    protected function saveAvailabilities($property)
    {
        foreach ($this->availabilities as $availability) {
            $property->availabilities()->create([
                'day' => $availability['day'],
                'start_time' => $availability['start_time'],
                'end_time' => $availability['end_time']
            ]);
        }
    }

    // Save Photo
    protected function savePhoto($property)
    {
        // dd($this->photo);
        if ($this->authorize('access-function', 'property-add-photo') && $this->photo) {
            $filename = uniqid() . '.webp';
            $filePath = Str::slug(auth()->user()->business->name) . '/properties/' . $property->id . '/';
            $filenameComplete = $filePath . $filename;

            $this->photo->storeAs(path: $filePath, name: $filename);

            $property->update([
                'photo' => $filenameComplete
            ]);

            Bus::dispatch(new ImageOptimizationSquare($filenameComplete));
        }
    }

    // Save Phones
    protected function savePhones($property)
    {
        foreach ($this->phones as $phone) {
            if ($phone['model'] == 'customer') {
                $this->customer->phones()->create([
                    'number' => $phone['number'],
                    'tag' => $phone['tag'],
                    'type' => $phone['type'],
                    'order' => $phone['id'],
                ]);
            } else {
                $property->phones()->create([
                    'number' => $phone['number'],
                    'tag' => $phone['tag'],
                    'type' => $phone['type'],
                    'order' => $phone['id'],
                ]);
            }
        }
    }

    // File Handling
    #[On('change-files-property-photo')]
    public function changePhoto($value)
    {
        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
        $this->photo = $file;
    }

    #[On('remove-files-property-photo')]
    public function removeFile()
    {
        $this->photo = null;
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

    #[On('updateLatLong')]
    public function updateLatLong($lat, $lng)
    {

        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    // #[On('updateAddress')]
    // public function updateAddress($address)
    // {
    //     $this->address = $address;
    // }


    // Phone Management
    public function addPhone()
    {
        $this->authorize('access-function', 'property-add-phone');
        if (!authorizeFeatureCount('property-add-phone', $this->phones, $this)) {
            return;
        }

        $validated = $this->validate([
            'number' => 'required|numeric',
            'tagNumber' => 'required',
            'phoneModel' => 'required',
            'typeNumber' => 'required'
        ], $this->phoneMessages());

        $this->phones[] = [
            'id' => count($this->phones) + 1,
            'number' => $this->number,
            'tag' => $this->tagNumber,
            'type' => $this->typeNumber,
            'model' => $this->phoneModel
        ];

        $this->number = '';
        $this->tagNumber = '';
        $this->typeNumber = '';


        $this->dispatch('notification', [
            'message' => 'Teléfono agregado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }


     // Custom Validation Messages for Phone
     protected function phoneMessages()
     {
         return [
             'number.required' => 'El número es obligatorio.',
             'number.numeric' => 'El número debe ser un valor numérico.',
             'tagNumber.required' => 'El tag del número es obligatorio.',
             'phoneModel.required' => 'El modelo del teléfono es obligatorio.',
             'typeNumber.required' => 'El tipo de número es obligatorio.',
         ];
     }

    public function updateTaskOrder($order)
    {
        $orderedPhones = [];

        foreach ($order as $item) {
            $orderedPhones[] = collect($this->phones)->firstWhere('id', $item['value']);
        }

        $this->phones = $orderedPhones;
    }

    public function removePhone($id)
    {
        $this->authorize('access-function', 'property-remove-phone');
        $this->phones = collect($this->phones)->reject(function ($phone) use ($id) {
            return $phone['id'] == $id;
        })->values()->toArray();

        $this->dispatch('notification', [
            'message' => 'Teléfono eliminado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    #[On('updateAvailabilities')]
    public function addAvailability($availabilities)
    {
        $this->availabilities = $availabilities;
    }


    //METODOS DE ACTUALIZACION DE LATITUD Y LONGITUD
    #[On('receive-start-lat')]
    public function updateLatitude($value){
        $this->latitude = $value;
     
    }

    #[On('receive-start-long')]
    public function updateLongitude($value){
        $this->longitude = $value;
      
    }


    #[On('updateAddress')]
    public function updateAddress($address)
    {
        $this->address = $address;
    }


    public function render()
    {
        return view('livewire.panel.property.add-property')
            ->layout('layouts.panel');
    }
}
