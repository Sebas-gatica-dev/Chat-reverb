<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Enums\PaymentMethodEnum;
use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationScale;
use App\Livewire\Components\MultiSelectGeneral;
use App\Models\Property;
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


class AddVisit extends Component
{
    use WithFileUploads;

    public ?Property $property;
    public $customer;

    public $searchUsers;

    public $users;
    public $coordinate = true;
    public $personalizedDate = false;
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

    public $created_by;

    public $message;

    public $files = [];

    public $newFiles = [];

    public $availabilities = [];


    public $test_user;


    public function mount()
    {
        $this->authorize('access-function', 'visit-add');
        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });


        $this->typeVisits = auth()->user()->business->visitsTypes()->get()->map(function ($typeVisit) {
            return [
                'id' => $typeVisit->id,
                'name' => $typeVisit->name,
            ];
        });

        $this->services = auth()->user()->business->services()->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });


        //Enum PaymentMethodEnums
        $this->expectedPayments = collect(PaymentMethodEnum::cases())->map(function ($paymentEnum) {
            return [
                'id' => $paymentEnum->value,
                'name' => PaymentMethodEnum::getMethod($paymentEnum),
            ];
        })->toArray();

         


        $this->dataFillingToggle();
    }



    public function rules()
    {
        return [
            'selectedTypeVisit' => 'required',
            // 'selectedUsers' => 'required',
            'selectedServices' => 'required',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'price' => 'required',
            'message' => 'required|min:5',
            'files.*' => 'file', // 1MB Max
            'selectedExpectedPayment' => 'required',
            'created_by' => 'required|exists:users,id',
        ];
    }


    public function addVisit()
    {

        $this->validate();



        $visit = $this->property->visits()->create([
            'date' => $this->date,
            'time' => $this->time,
            'price' => $this->price,
            'iva' => $this->checked,
            'status' => 0,
            'expected_payment' => $this->selectedExpectedPayment,
            'visit_type_id' => $this->selectedTypeVisit['id'],
            'property_id' => $this->property->id,
            'customer_id' => $this->customer,
            'created_by' => $this->created_by,
            'duration_time' => 45,
            'business_id' => auth()->user()->business->id,
        ]);

        if ($this->selectedUsers) {
            $visit->users()->attach(array_column($this->selectedUsers, 'id'));
        }
        $visit->services()->attach(array_column($this->selectedServices, 'id'));


        foreach ($this->availabilities as $availability) {

            $visit->availabilities()->create([
                'day' => $availability['day'],
                'start' => $availability['start_time'],
                'end' => $availability['end_time']
            ]);
        }


        $comment =  $visit->comments()->create([
            'message' => $this->message,
            'user_id' => auth()->id(),
        ]);

        // dd($comment, $visit);



        if ($this->files) {


            foreach ($this->files as $file) {
                $filename = null;

                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {

                    $filePath = Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/files/';
                    $filename = uniqid() . '.' . $file->extension();
                    $filenameComplete = $filePath . $filename;

                     // Guarda el archivo
                    $file->storeAs($filePath, $filename);


                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath); // Obtener el tamaño desde el archivo guardado
                    $fileType = pathinfo($storedFilePath, PATHINFO_EXTENSION); // Obtener la extensión del archivo guardado

               
                    
                      // Crea el registro del archivo en la base de datos
                $fileSaved = $comment->files()->create([
                    'name' => $filename,
                    'path' => $filenameComplete,
                    'size' => $fileSize,
                    'type' => $fileType,
                    'user_id' => auth()->id(),
                ]);
    
                // Elimina el archivo temporal de Livewire
                $file->delete();
    
                // Despacha el Job para optimización de imágenes
                Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));

                } else {

                    $filename =  Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/' . '/files/' . uniqid() . '.' . $file->extension();
                    $uploadFile = $file->getRealPath();
                    Storage::put($filename, file_get_contents($uploadFile));

                     // Crear la foto en la base de datos
                    $comment->files()->create([
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
            'message' => 'Visita creada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->customer, $this->property->id], true, true);
    }

    public function setCoordinate()
    {
       $this->coordinate = !$this->coordinate;
    }

    public function setPersonalizedDate()
    {
       $this->personalizedDate = !$this->personalizedDate;
    }

    // public function updatedFiless($files)
    // {

    //    if($this->files){
    //        $this->files = array_merge($this->files, $files);
    //      }else{
    //         $this->files = $files;
    //      }



    // }

    // public function removeFile($index)
    // {
    //     unset($this->files[$index]);
    //     $this->files = array_values($this->files);
    // }

    // public function updatedNewFiles()
    // {
    //     $this->validate([
    //         'newFiles.*' => 'file|max:10024', // 1MB Max
    //     ]);

    //     // Combinar las nuevas fotos con las fotos existentes
    //     $this->files = array_merge($this->files, $this->newFiles);
    //     $this->newFiles = [];
    // }




    #[On('change-files')]
    public function changeFiles($values)
    {
        $this->files = [];
        $this->getFileValues($values);
    }

    #[On('remove-files')]
    public function removeFile($values)
    {

        $this->files = [];
        $this->getFileValues($values);
    }


    public function getFileValues($values)
    {


        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->files[] = $file;
        }
    }
    public function dataFillingToggle()
    {
        //$this->answer = "¿Desea incluir IVA en la visita?";
        $this->checked = false;
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

        if ($value) {
            $this->selectedExpectedPayment = $value['id'];
        } else {
            $this->selectedExpectedPayment = null;
        }
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



    #[On('select-visit')]
    public function selectVisit($date, $time, $worker)
    {

      
            $this->selectedUsers = [];
            $this->dispatch('clear-selected-values-users')->to(MultiSelectGeneral::class);
        

        $this->date = $date;
        $this->time = $time;

        $this->dispatch('dispatch-selected-values-users', id: $worker)->to(MultiSelectGeneral::class);

    }




    #[On('updateAvailabilities')]
    public function addAvailability($availabilities)
    {
        $this->availabilities = $availabilities;
    }
    public function render()
    {
        return view('livewire.panel.property.visit.add-visit')->layout('layouts.panel');
    }
}
