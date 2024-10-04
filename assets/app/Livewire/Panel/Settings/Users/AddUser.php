<?php

namespace App\Livewire\Panel\Settings\Users;

use App\Enums\TransportEnum;
use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationSquare;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Component\Mailer\Transport;
use App\Traits\ValidateNotificationTrait;


class AddUser extends Component
{
    use WithFileUploads, ValidateNotificationTrait;

    public $name;
    public $email;
    public $showPassword = false;
    public $password;
    public $photo;
    public $business_id;
    public $email_verified_at;
    public $selectedRoles = [];
    public $roles = [];
    public $branches = [];
    public $selectedBranches = [];

    public $transport;
    public $transports;
    public $password_confirmation;

    public $availabilities = [];
    public $branchesCoordenates = [];


    public $start_lat;
    public $start_long;
    public $address;
    public $coordSelect;
    public $preselectedAdress = [];


    public function mount()
    {

        $this->authorize('access-function', 'user-add');
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

        $this->transports = TransportEnum::cases();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|string|min:6|same:password',
            'selectedRoles' => 'required',
            'transport' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe tener más de 120 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
            'password_confirmation.string' => 'La confirmación de la contraseña debe ser una cadena de texto.',
            'password_confirmation.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password_confirmation.same' => 'La confirmación de la contraseña debe coincidir.',
            'selectedRoles.required' => 'Debe seleccionar al menos un rol.',
            'transport.required' => 'Debe seleccionar un transporte.',
        ];
    }





    public function save($typeSave)
    {

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'business_id' => auth()->user()->business->id,
            'transport' => $this->transport,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'start_lat' => $this->start_lat,
            'start_lng' => $this->start_long,
            'address' => $this->address

        ]);


        foreach ($this->availabilities as $availability) {

            $user->availabilities()->create([
                'day' => $availability['day'],
                'start' => $availability['start_time'],
                'end' => $availability['end_time']
            ]);
        }

        if ($this->photo) {


            // Crear un nombre único para la imagen
            $filename =   uniqid() . '.webp';
            $filePath = Str::slug(auth()->user()->business->name) . '/users/' . $user->id . '/';
            $filenameComplete = $filePath . $filename;
            // Guardar la imagen optimizada en el storage

            $this->photo->storeAs(path: $filePath, name: $filename);

            // Actualizar la propiedad con la ruta de la imagen optimizada
            $user->update([
                'photo' => $filenameComplete
            ]);

            Bus::dispatch(new ImageOptimizationSquare($filenameComplete));
        }

        if ($this->selectedRoles) {
            $user->roles()->attach(array_column($this->selectedRoles, 'id'));
        }




        if ($this->selectedBranches) {
            $user->branches()->attach(array_column($this->selectedBranches, 'id'));
        }





        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Usuario creado correctamente',
                'type' => Notifications::icons('success')
            ]);
            return redirect()->route('panel.settings.users.list');
        } elseif ($typeSave == 'save-new') {

            session()->flash('notification', [
                'message' => 'Usuario creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return redirect()->route('panel.settings.users.create');
        } else {
            return redirect()->route('panel.settings.users.list');
        }
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
    public function render()
    {
        return view('livewire.panel.settings.users.add-user')
            ->layout('layouts.panel');
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
    public function addAvailability($availabilities)
    {


        $this->availabilities = $availabilities;
    }



    #[On('receive-start-lat')]
    public function updateStartLat($value)
    {
        $this->start_lat = $value;
    }

    #[On('receive-start-long')]
    public function updateStartLong($value)
    {
        $this->start_long = $value;
    }

    #[On('receive-address')]
    public function updateAddress($value)
    {
        $this->address = $value;
    }


    //METODO PARA ACTUALIZAR LAS COORDENADAS
    public function updatedCoordSelect($value)
    {
        //dd($value);
        $this->dispatch('coordSelect', $value);
    }
}
