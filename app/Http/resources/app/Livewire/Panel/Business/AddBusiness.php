<?php

namespace App\Livewire\Panel\Business;

use App\Helpers\Notifications;
use App\Models\Business;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Models\Branch;
use App\Models\Industry;
use App\Models\Role;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Jobs\ImageOptimizationSquare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class AddBusiness extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255|unique:businesses,name')]
    public $name;
    #[Validate('image|nullable')]
    public $logo;
    #[Validate('required|string|max:255')]
    public $address;
    #[Validate('required|string|max:255')]
    public $phone;
    #[Validate('required|email')]
    public $email;


    public $latitude;
    public $longitude;



    public $industries;

    #[Validate('required')]
    public $selectedIndustry;


    public function mount()
    {

        if (auth()->user()->business) {
            $this->redirectRoute('panel.dashboard');
        }


        $this->industries = Industry::get()->map(function ($industry) {
            return [
                'id' => $industry->id,
                'name' => $industry->name,
            ];
        })->toArray();
    }

    public function save()
    {
        $this->validate();


        $business = Business::create([
            'name' => $this->name,
            'logo' => $this->logo,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_by' => auth()->id(),
            'industry_id' => $this->selectedIndustry,
        ]);


        if ($this->logo) {

           $filename = uniqid().'.webp';
           $filePath = Str::slug(auth()->user()->business->name).'/logos/'.$business->id.'/';
           $filenameComplete = $filePath . $filename;

           $this->logo->storeAs(path: $filePath, name: $filename);

            $business->update([
                'logo' => $filename
            ]);

            Bus::dispatch(new ImageOptimizationSquare($filenameComplete));
   
        }

        // Crear una sucursal por defecto
       $branch = Branch::create([
            'business_id' => $business->id,
            'name' => 'Principal', // Nombre por defecto para la sucursal
            'address' => $this->address, // Usar la misma dirección del negocio
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_by' => auth()->id(),
        ]);

        //Asociar el usuario a la sucursal
        $branch->users()->attach(auth()->id());


        //Duplicar roles que tengan business_id null y asignarlos al negocio
       $business->duplicateRoles();

       Auth::user()->update([
           'business_id' => $business->id
       ]);

       //Asignar el rol de master al creador del business
      $idAdminRol= $business->roles()->where('name', 'Administrador')->first()->id;

       $business->createdBy->roles()->attach($idAdminRol);

        session()->flash('notification', [
            'message' => 'Negocio creado correctamente',
            'type' => Notifications::icons('success')
        ]);


        return $this->redirectRoute('panel.settings.my-subscription.changue-plan');
    }




    #[On('change-files-business-files')]
    public function changeLogo($value)
    {

         $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
         $this->logo = $file;
    }

    #[On ('remove-files-business-files')]
    public function removeLogo(){

        $this->logo = null;
    }


    #[On('update-selected-value-industries')]
    public function updateSelectedIndustries($value)
    {

        $this->selectedIndustry = $value;
    }

    #[On('update-search-industries')]
    public function searchIndustries($value)
    {

        $this->industries = Industry::when($value, function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        })->get()->map(function ($industry) {
            return [
                'id' => $industry->id,
                'name' => $industry->name,
            ];
        });

        $this->dispatch('update-values-industries', $this->industries);

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
        return view('livewire.panel.business.add-business')
            ->layout('layouts.panel');
    }
}
