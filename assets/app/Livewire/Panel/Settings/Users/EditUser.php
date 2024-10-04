<?php

namespace App\Livewire\Panel\Settings\Users;

use App\Enums\TransportEnum;
use Livewire\Component;
use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationSquare;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;
use App\Traits\ValidateNotificationTrait;


class EditUser extends Component
{

    use WithFileUploads, ValidateNotificationTrait;

    public ?User $user;
    public $name;
    public $email;

    public $showPassword = true;
    public $password;
    public $photo = [];
    public $business_id;
    public $email_verified_at;

    public $selectedRoles = [];
    public $roles = [];

    public $password_confirmation;

    public $selectedBranches = [];

    public $branches;

    public $transports;
    public $transport;

    public $availabilities = [];



    public $start_lat;
    public $start_long;
    public $address;
    public $coordSelect;
    public $preselectedAddress;




    public function mount()
    {
        $this->authorize('access-function', 'user-edit');
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->email_verified_at = $this->user->email_verified_at;
        $this->business_id = $this->user->business_id;
        $this->transport = $this->user->transport;
        $this->photo[] = $this->user->photo;
        $this->selectedRoles = $this->user->roles()->get()->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        })->toArray();
        $this->start_lat = $this->user->start_lat;
        $this->start_long = $this->user->start_lng;
        $this->address = $this->user->address;

        $this->roles = Role::where('business_id', auth()->user()->business->id)->get()->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        });

        $this->branches = auth()->user()->business->branches()->get()->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
                'latitude' => $branch->latitude,
                'longitude' => $branch->longitude,
                'address' => $branch->address,
            ];
        });

        $this->selectedBranches = $this->user->branches()->get()->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
            ];
        })->toArray();

        $this->transports = TransportEnum::cases();


        // Fetching availabilities
        $this->availabilities = $this->user->availabilities->map(function ($availability) {
            return [
                'id' => $availability->id,
                'day' => $availability->day->value, // Convert enum to value
                'start_time' => substr($availability->start, 0, 5),
                'end_time' => substr($availability->end, 0, 5),
            ];
        })->toArray();




         $this->findUserPreselectedBranchAddress($this->branches);

    }

    public function validationAttributes()
    {
        return [
            'transport' => 'transporte',
        ];
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|string|min:6|same:password',
            'selectedRoles' => 'required',
            'transport' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede tener más de 120 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide.',
            'selectedRoles.required' => 'Debe seleccionar al menos un rol.',
            'transport.required' => 'El transporte es obligatorio.',
        ];
    }



    public function findUserPreselectedBranchAddress($branches)
    {
       foreach ($branches as $branch) {
           if ($branch['latitude'] == $this->start_lat && $branch['longitude'] == $this->start_long) {
               $this->address = $branch['address'];
               $this->dispatch('updateAddress', address: $this->address);
               break;
           }else{
              $this->address = $this->address ?? 'Ubicacion personalizada';
              $this->dispatch('updateAddress', address: $this->address);
           }
       }
    }

    public function update()
    {

        $this->authorize('access-function', 'user-edit');
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'business_id' => auth()->user()->business->id,
            'transport' => $this->transport,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'start_lat' => $this->start_lat,
            'start_lng' => $this->start_long,
            'address' => $this->address

        ]);

        if ($this->password) {
            $this->user->update([
                'password' => Hash::make($this->password)
            ]);
        }

        // Delete existing availabilities
        $this->user->availabilities()->delete();

        // Create new availabilities
        foreach ($this->availabilities as $availability) {
            $this->user->availabilities()->create([
                'day' => $availability['day'],
                'start' => $availability['start_time'],
                'end' => $availability['end_time']
            ]);
        }


        if(($this->photo == null) && $this->user->getRawOriginal('photo')){
            Storage::delete($this->user->getRawOriginal('photo'));
            $this->user->update([
                'photo' => null
            ]);
        }

        if ($this->photo instanceof TemporaryUploadedFile) {

            if($this->user->getRawOriginal('photo')){
                Storage::delete($this->user->getRawOriginal('photo'));
            }


            // $manager = new ImageManager(new Driver());

            // Redimensionar y optimizar la imagen
            // $image = $manager->read($this->photo->getRealPath())
            //     ->coverDown(500, 500, 'center')->toWebp(60);

            // Crear un nombre único para la imagen
            $filename =   uniqid() . '.webp';
            $filePath = Str::slug(auth()->user()->business->name) . '/users/' . $this->user->id . '/';
            $filenameComplete = $filePath . $filename;            // Guardar la imagen optimizada en el storage

            $this->photo->storeAs(path: $filePath, name: $filename); 

            // Actualizar la propiedad con la ruta de la imagen optimizada
            $this->user->update([
                'photo' => $filenameComplete
            ]);


             Bus::dispatch(new ImageOptimizationSquare($filenameComplete));

        }

        $this->user->roles()->sync(array_column($this->selectedRoles, 'id'));

        $this->user->branches()->sync(array_column($this->selectedBranches, 'id'));

        session()->flash('notification', [
            'message' => 'Usuario actualizado correctamente',
            'type' => Notifications::icons('success')

        ]);

        return redirect()->route('panel.settings.users.list');
    }



    #[On('update-selected-values-roles')]
    public function updateSelectedRoles($value)
    {

        $this->selectedRoles = $value;
    }

    #[On('update-search-roles')]
    public function searchRole($search)
    {

        $this->roles = Role::where('business_id', auth()->user()->business->id)->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get()->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        });



        $this->dispatch('update-values-roles', $this->roles);
    }






    #[On('change-files-user-photo')]
    public function changePhoto($value)
    {

        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
        $this->photo = $file;
    }

    #[On('remove-files-user-photo')]
    public function removeFile()
    {

        $this->photo = null;
    }

    #[On('remove-files-existing-user-photo')]
    public function removePhotoExisting()
    {
        $this->photo = null;
    }



    #[On('update-selected-values-branches')]
    public function updateSelectedBranches($value)
    {

        $this->selectedBranches = $value;
    }

    #[On('update-search-branches')]
    public function searchBranches($search)
    {

        $searchBranches = $search;

        $this->branches = auth()->user()->business->branches()
            ->when($searchBranches, function ($query) use ($searchBranches) {
                $query->where('name', 'like', '%' . $searchBranches . '%');
            })->get()->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->name,
                ];
            });

        $this->dispatch('update-values-branches', $this->branches);
    }

    #[On('updateAvailabilities')]
    public function updateAvailability($availabilities)
    {

        $this->availabilities = $availabilities;
    }


     
     //METODOS DE ACTUALIZACION DE LATITUD Y LONGITUD
     #[On('receive-start-lat')]
     public function updateStartLat($value){
         $this->start_lat = $value;
      
     }
 
     #[On('receive-start-long')]
     public function updateStartLong($value){
         $this->start_long = $value;
       
     }



     #[On('receive-address')]
     public function receiveAddress($value){
         $this->address = $value;
     }


//    #[On('updateLatLong')]
//    public function updateLatLong($lat, $lng)
//    {
//        $this->start_lat = $lat;
//        $this->start_long = $lng;
//    }









   #[On('updateAddress')]
   public function updateAddress($address)
   {
       $this->address = $address;
   }


   public function updatedCoordSelect($value)
   {
    //dd($value);
    $this->dispatch('coordSelect', $value);
   }





    public function render()
    {
        return view('livewire.panel.settings.users.edit-user')
            ->layout('layouts.panel');
    }
}
