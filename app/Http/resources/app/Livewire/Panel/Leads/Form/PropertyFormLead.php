<?php

namespace App\Livewire\Panel\Leads\Form;
use Illuminate\Support\Facades\Auth;
use App\Enums\FrequencyEnum;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Province;
use App\Rules\ValidCuitOrDni;
use Livewire\Attributes\On;
use Livewire\Component;

class PropertyFormLead extends Component
{


    public $provinces = [];
    public $cities = [];
    public $neighborhoods = [];
    public $subzones = [];
    public $latitude;
    public $longitude;
    public $address;
    public array $data = [];
    public $selectedProvince;
    public $selectedCity;
    public $selectedNeighborhood;
    public $selectedSubzone;

    public $propertiesTypes = [];
    public $availabilities = [];

    public $branches = [];

    public $frequencies = [];

    public $idModel = 'property-form-lead';

    private $zones  = [
        'data.province_id',
        'data.city_id',
        'data.neighborhood_id',
        'data.subzone_id'
    ];



    public function rules()
    {
        return [
            'data.address' => 'nullable|min:3',
            'data.between_streets' => 'nullable|min:3',
            'data.floor' => 'nullable|min:1',
            'data.apartament' => 'nullable|min:1',
            'data.documentation' => ['nullable', 'string', new ValidCuitOrDni],
            // 'data.surname' => 'nullable|min:3',
            // 'data.date_lead' => 'nullable|date',
            // 'data.time_lead' => 'nullable|date_format:H:i',
            // 'data.email' => 'nullable|email',

        ];
    }


    public function getListeners()
    {
        return [
            "update-selected-value-live-{$this->idModel}" => 'updatedData',

        ];
    }

    public function mount()
    {

      
        $this->provinces = Province::whereIn('id', auth()->user()->business->provinces->pluck('province_id'))->get()->map(function ($province) {
            return [
                'id' => $province->id,
                'name' => $province->name

            ];
        })->toArray();


        $this->propertiesTypes = PropertyType::where('business_id', auth()->user()->business_id)->get()->map(function ($type) {
            return [
                'id' => $type->id,
                'name' => $type->name
            ];
        })->toArray();


        $this->frequencies = collect(FrequencyEnum::cases())->map(function ($frequency) {
            return [
                'id' => $frequency->value,
                'name' => $frequency->getName()
            ];
        })->toArray();

        $this->branches = Auth::user()->business->branches()->whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->get()->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name
            ];
        })->toArray();

        // Load dependent data based on existing selections
        $this->loadDependentData();

    }
    public function updatedData($value, $input)
    {
        // Validar solo el campo que cambió (por ejemplo "data.name")
        $this->validateOnly('data.' . $input);
        // Guardar solo el campo que cambió
        $this->saveField($value, $input);
        $this->dispatch('data.' . $input);
    }

    public function saveField($value, $input)
    {
        // Extraer el nombre del campo (ej. "name" en vez de "data.name")
        $field = str_replace('data.', '', $input);

        // Guardar el campo modificado en la base de datos
        Property::where('id', $this->data['id'])->update([
            $field => $value
        ]);

        $this->data[$field] = $value;


        $this->dispatch(sprintf('action-after-save-%s', $field), $value);

        $this->dispatch('updateDataLeadAndStep', step: 2);

        
    }


    #[On('receive-start-lat')]
    public function updateDataLatitude($value)
    {

        $this->data['latitude'] = $value;
    }

    #[On('receive-start-long')]
    public function updateDataLongitude($value)
    {
        $this->data['longitude'] = $value;
    }


    #[On('updateAddress')]
    public function updateDataAddress($address)
    {

        $this->data['address'] = $address;

        $this->updatedData($address, 'address');
    }

    #[On('updateLatLong')]
    public function updateLatLong($lat, $lng)
    {



        $this->data['latitude'] = $lat;
        $this->data['longitude'] = $lng;


        $this->updatedData($lat, 'latitude');
        $this->updatedData($lng, 'longitude');
    }


    #[On('action-after-save-province_id')]
    public function updatedDataProvinceId($value)
    {
      

        

        $this->cities = auth()->user()->business->cities->where('city.province_id', $value)->map(function ($city) {
            return [
                'id' => $city->city->id,
                'name' => $city->city->name
            ];
        })->toArray();

        $this->cities = array_values($this->cities);

        $this->data['city_id'] = $this->data['neighborhood_id'] = $this->data['subzone_id'] = null;

        $this->selectedCity = $this->selectedNeighborhood = $this->selectedSubzone = null;
        $this->dispatch('update-values-data.city_id', $this->cities);

        $this->dispatch('clear-selected-value-data.city_id',  $this->selectedCity);
    }

    #[On('action-after-save-city_id')]
    public function updatedDataCityId($value)
    {   
    
        $this->neighborhoods = auth()->user()->business->neighborhoods->where('neighborhood.city_id', $value)->map(function ($neighborhood) {
            return [
                'id' => $neighborhood->neighborhood->id,
                'name' => $neighborhood->neighborhood->name
            ];
        })->toArray();

        $this->neighborhoods = array_values($this->neighborhoods);

        $this->data['neighborhood_id'] = $this->data['subzone_id'] = null;

       $this->selectedNeighborhood = $this->selectedSubzone = null;
        
        $this->dispatch('update-values-data.neighborhood_id', $this->neighborhoods);

        $this->dispatch('clear-selected-value-data.neighborhood_id',  $this->selectedNeighborhood);
    }


    #[On('action-after-save-neighborhood_id')]
    public function updatedDataNeighborhoodId($value)
    {

        $this->subzones = auth()->user()->business->subzones->where('subzone.neighborhood_id', $value)->map(function ($subzone) {
            return [
                'id' => $subzone->subzone->id,
                'name' => $subzone->subzone->name
            ];
        })->toArray();


        $this->subzones = array_values($this->subzones);

        $this->data['subzone_id'] = null;

        $this->selectedSubzone = null;

        $this->dispatch('update-values-data.subzone_id', $this->subzones);

        $this->dispatch('clear-selected-value-data.subzone_id',  $this->selectedSubzone);
    }


    private function loadDependentData()
    {
        // Load cities if province is selected
        if ($this->data['province_id']) {
            // dd($this->data);
            $this->selectedProvince = $this->data['province_id'];
     
            

            $this->cities = auth()->user()->business->cities->where('city.province_id', $this->data['province_id'])->map(function ($city) {
                return [
                    'id' => $city->city->id,
                    'name' => $city->city->name
                ];
            })->toArray();

          
            $this->cities = array_values($this->cities);
            
        }

        // Load neighborhoods if city is selected
        if ($this->data['city_id']) {
            $this->selectedCity = $this->data['city_id'];
            
            $this->neighborhoods = auth()->user()->business->neighborhoods->where('neighborhood.city_id', $this->data['city_id'])->map(function ($neighborhood) {
                return [
                    'id' => $neighborhood->neighborhood->id,
                    'name' => $neighborhood->neighborhood->name
                ];
            })->toArray();

            $this->neighborhoods = array_values($this->neighborhoods);
        }

        // // Load subzones if neighborhood is selected
        if ($this->data['neighborhood_id']) {

            $this->selectedNeighborhood = $this->data['neighborhood_id'];
          
            $this->subzones = auth()->user()->business->subzones->where('subzone.neighborhood_id', $this->data['neighborhood_id'])->map(function ($subzone) {
                return [
                    'id' => $subzone->subzone->id,
                    'name' => $subzone->subzone->name
                ];
            })->toArray();
    
            $this->subzones = array_values($this->subzones);
        }

        if($this->data['subzone_id']){
            $this->selectedSubzone = $this->data['subzone_id'];
        }
        
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



    
    #[On('updateAvailabilities')]
    public function updateAvailabilities($availabilities)
    {
        $this->data['availabilities'] = $availabilities;


        $property = Property::find($this->data['id']);
    

        $property->availabilities()->delete();

        foreach ($this->data['availabilities'] as $availability) {
            $property->availabilities()->create([
                'day' => $availability['day'],
                'start_time' => $availability['start_time'],
                'end_time' => $availability['end_time']
            ]);
        }



        
       // dd($property, $this->data['availabilities']);

    }




    public function render()
    {
        return view('livewire.panel.leads.form.property-form-lead');
    }
}
