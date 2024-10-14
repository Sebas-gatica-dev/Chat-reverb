<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Enums\PaymentMethodEnum;
use App\Helpers\Notifications;
use App\Jobs\ImageDeleteJob;
use App\Models\Property;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Bus;
use Intervention\Image\ImageManager;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Jobs\ImageOptimizationScale;


class EditVisit extends Component
{
    public Visit $visit;
    public $searchUsers;

    public $users;
    public $typeVisits;

    public $selectedTypeVisit;

    public $selectedUsers = [];

    public $services = [];

    public $date;
    public $time;


    public $selectedServices = [];


    public $checked;

    public $answer;

    public $selectedExpectedPayment;

    public $expectedPayments;

    public $price;


    public $message;
    public $duration_time;


    public $newFiles = [];

    public $filesExisting = []; //Guardamos archivos existentes

    public $initialFilesExisting = []; //Guardamos estado inicial de los archivos

    public $availabilities = [];

    public function mount()
    {
        $this->authorize('access-function', 'visit-edit');
        $this->selectedUsers = $this->visit->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        })->toArray();

        // $this->users = $this->visit->property->branch->users;
        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });

        $this->selectedTypeVisit = [
            'id' => $this->visit->visitType->id,
            'name' => $this->visit->visitType->name,
        ];

        $this->typeVisits = auth()->user()->business->visitsTypes()->get()->map(function ($typeVisit) {
            return [
                'id' => $typeVisit->id,
                'name' => $typeVisit->name,
            ];
        });

        $this->selectedServices = $this->visit->services()->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        })->toArray();

        $this->services = auth()->user()->business->services()->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });

        $this->selectedExpectedPayment = [
            'id' => $this->visit->expected_payment->value,
            'name' => PaymentMethodEnum::getMethod($this->visit->expected_payment),
        ];


        //Enum PaymentMethodEnums
        $this->expectedPayments = collect(PaymentMethodEnum::cases())->map(function ($paymentEnum) {
            return [
                'id' => $paymentEnum->value,
                'name' => PaymentMethodEnum::getMethod($paymentEnum),
            ];
        })->toArray();


        $this->date = $this->visit->date;
        $this->time = Carbon::parse($this->visit->time)->format('H:i');

        $this->price = $this->visit->price;
        $this->checked = $this->visit->iva;
        $this->duration_time = $this->visit->duration_time;

        $this->message = $this->visit->comments->first()->message;


        $this->filesExisting = $this->visit->comments->first()->files->map(function ($file) {
            return [
                'id' => $file->id,
                'name' => $file->name,
                'path' => $file->path,
                'type' => $file->type,
            ];
        })->toArray();

        $this->initialFilesExisting =  $this->filesExisting; //Guardamos estado inicial de los archivos



        // Fetching availabilities
        $this->availabilities = $this->visit->availabilities->map(function ($availability) {
            return [
                'id' => $availability->id,
                'day' => $availability->day->value, // Convert enum to value
                'start_time' => substr($availability->start, 0, 5),
                'end_time' => substr($availability->end, 0, 5),
            ];
        })->toArray();
    }




    public function rules()
    {
        return [
            'selectedTypeVisit' => 'required',
            'selectedServices' => 'required',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'duration_time' => 'nullable|numeric',
            'price' => 'required',
        ];
    }


    public function save()
    {


        $this->validate();



        $this->visit->update([
            'date' => $this->date,
            'time' => $this->time,
            'price' => $this->price,
            'duration_time' => $this->duration_time,
            'iva' => $this->checked,
            'expected_payment' => $this->selectedExpectedPayment['id'],
            'visit_type_id' => $this->selectedTypeVisit['id'],

        ]);

        //actualizar mensaje si es necesario
        if ($this->visit->comments()->first()->message != $this->message) {
            $this->visit->comments()->first()->update(['message' => $this->message]);
        }


        //sincronizar usuarios y servicios
        $this->visit->users()->sync(array_column($this->selectedUsers, 'id'));
        $this->visit->services()->sync(array_column($this->selectedServices, 'id'));


        // Actualizar disponibilidad
        $this->visit->availabilities()->delete();

        foreach ($this->availabilities as $availability) {
            $this->visit->availabilities()->create([
                'day' => $availability['day'],
                'start' => $availability['start_time'],
                'end' => $availability['end_time']
            ]);
        }


        //Si es verdadero, significa que se han eliminado algunos archivos previamente existentes
        if (($this->filesExisting != $this->initialFilesExisting)) {

            if (count($this->filesExisting) > 0) {
                foreach ($this->visit->comments()->first()->files as $file) { //Recorro todos los FILES de la VISITA
                    // Eliminar los archivos que no estan en la lista de archivos
                    if (!in_array($file->id, array_column($this->filesExisting, 'id'))) {

                        $filePath = $file->getRawOriginal('path');

                        //Job para borrar archivos
                        Bus::dispatch(new ImageDeleteJob($file, $filePath));
   
                    }
                }

            } else {

                // Eliminar todos los archivos
                foreach ($this->visit->comments()->first()->files as $file) {

                    $filePath = $file->getRawOriginal('path');

                    //Job para borrar archivos
                    Bus::dispatch(new ImageDeleteJob($file, $filePath));
                }

            }
        }


        if ($this->newFiles) {


            foreach ($this->newFiles as $file) {
                $filename = null;

                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp','tiff'])) {


                    $filePath = Str::slug(auth()->user()->business->name) . '/bank_accounts/' . $this->bankAccount->id . '/files/';

                    $filename = uniqid() . '.' . $file->extension();

                    $filenameComplete = $filePath . $filename;


                    $file->storeAs(path: $filePath, name: $filename);


                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath); // Obtener el tamaño desde el archivo guardado
                    $fileType = pathinfo($storedFilePath, PATHINFO_EXTENSION); // Obtener la extensión del archivo guardado


                    $fileSaved =   $this->visit->comments->files()->create([
                        'name' => $filename,
                        'path' => $filenameComplete,
                        'size' => $fileSize,
                        'type' => $fileType,
                        'user_id' => auth()->id(),
                    ]);


                    $file->delete();

                    Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));


                } else {
                    $filename =  Str::slug(auth()->user()->business->name) . '/properties/' . $this->visit->property->id . '/files/' . uniqid() . '.' . $file->extension();
                    $uploadFile = $file->getRealPath();
                    Storage::put($filename, file_get_contents($uploadFile));

                        // Crear archivo en la base de datos
                    $this->visit->comments()->first()->files()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $filename,
                        'size' => $file->getSize(),
                        'type' => $file->extension(),
                        'user_id' => auth()->id(),

                    ]);
                }




               
            }
        }



        session()->flash('notification', [
            'message' => 'Visita actualizada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id], true, true);
    }


    #[On('update-checked')]
    public function changeChecked($value)
    {
        $this->checked = $value;
    }

    #[On('update-selected-values-users')]
    public function updateSelectedUsers($value)
    {

        $this->selectedUsers = $value;
    }

    #[On('update-search-users')]
    public function searchUsers($search)
    {

        $this->searchUsers = $search;

        $this->users = auth()->user()->business->users()
            ->when($this->searchUsers, function ($query) {
                $query->where('name', 'like', '%' . $this->searchUsers . '%');
            })->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            });

        $this->dispatch('update-values-users', $this->users);
    }




    #[On('update-selected-value-typeVisits')]
    public function updateSelectedTypeVisit($value)
    {


        $this->selectedTypeVisit = $value;
    }

    #[On('update-search-typeVisits')]
    public function searchTypeVisits($value)
    {

        $this->typeVisits = auth()->user()->business->visitsTypes()->when($value, function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        })->get()->map(function ($typeVisit) {
            return [
                'id' => $typeVisit->id,
                'name' => $typeVisit->name,
            ];
        });

        $this->dispatch('update-values-typeVisits', $this->typeVisits);
    }


    #[On('update-selected-value-expectedPayment')]
    public function updateSelectedExpectedPayment($value)
    {
        $this->selectedExpectedPayment = $value;
    }

    #[On('update-selected-values-services')]
    public function updateSelectedServices($value)
    {
        $this->selectedServices = $value;
    }

    #[On('update-search-services')]
    public function searchService($search)
    {

        $this->services = auth()->user()->business->services()->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });


        $this->dispatch('update-values-services', $this->services);
    }


    //Adicion de nuevos archivos
    #[On('change-files')]
    public function changeNewFiles($values)
    {

        $this->newFiles = [];
        $this->getFileValues($values);
    }

    //Eliminacion de nuevos archivos
    #[On('remove-files')]
    public function removeNewFile($values)
    {

        $this->newFiles = [];
        $this->getFileValues($values);
    }


    //Eliminacion de archivos existentes
    #[On('remove-files-existing')]
    public function removeFilesExisting($values)
    {

        $this->filesExisting = $values;
    }


    //Obtener la informacion temporal de los archivos nuevos
    public function getFileValues($values)
    {
        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->newFiles[] = $file;
        }
    }

    #[On('updateAvailabilities')]
    public function updateAvailability($availabilities)
    {

        $this->availabilities = $availabilities;

    }
    public function render()
    {
        return view('livewire.panel.property.visit.edit-visit')
            ->layout('layouts.panel');
    }
}
