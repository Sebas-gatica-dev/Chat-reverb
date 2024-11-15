<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Enums\PaymentMethodEnum;
use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationScale;
use App\Livewire\Components\MultiSelectGeneral;
use App\Models\Input;
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
use App\Enums\Forms\SectorTypeEnum;
use App\Enums\StatusVisitEnum;
use App\Models\Budget;
use App\Rules\FormDynamicRequired;
use Illuminate\Validation\Rule;
use App\Models\InputData;
use Livewire\Attributes\Computed;

class AddVisit extends Component
{
    use WithFileUploads;

    public ?Property $property;
    public $customer;
    public $searchUsers;
    public $users;
    public $coordinateLater = false;
    public $recommendedDate = false;
    public $typeVisits;
    public $selectedTypeVisit;
    public $selectedUsers = [];
    public $services = [];
    public $date;
    public $time;
    public $selectedServices = [];
    public $checked = false;
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
    public $routeSelected;
    public $formsDynamic = [];


    public $budgets = [];

    public $selectedBudget = null;


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
        })->toArray();

        $this->services = auth()->user()->business->services()->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });

        $this->expectedPayments = collect(PaymentMethodEnum::cases())->map(function ($paymentEnum) {
            return [
                'id' => $paymentEnum->value,
                'name' => $paymentEnum->getName(),
            ];
        })->toArray();

       

        $this->formsDynamic = Input::where('business_id', auth()->user()->business_id)
            ->where('sector', SectorTypeEnum::VisitCreate->value)
            ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
            ->orderBy('order', 'asc') // Ordenar por el campo 'order'
            ->get()
            ->mapWithKeys(function ($input) {
                return [
                    $input->id => [
                        'label' => $input->label,
                        'input_type' => $input->input_type,
                        'placeholder' => $input->placeholder,
                        'required' => $input->required,
                        'options' => $input->options,
                        'value' => null,
                    ],
                ];
            })->toArray();



        // Cargar presupuestos
        $this->budgets = Budget::where('customer_id', $this->customer)
            ->where(function ($query) {
                $query->whereNull('property_id')
                    ->orWhere('property_id', $this->property->id);
            })
            ->withTrashed()
            ->get()
            ->map(function ($budget) {
                $ivaText = $budget->iva ? '(+ IVA )' : '';
                $priceFormatted = '$' . number_format($budget->total, 0, ',', '.');

                return [
                    'id' => $budget->id,
                    'name' => "{$priceFormatted} {$ivaText} - {$budget->name}",
                    'price' => $budget->total,
                    'iva' => $budget->iva,
                ];
            })->toArray();

       
        
       
    }

    public function rules()
    {
        return [
            'selectedTypeVisit' => 'required',
            'formsDynamic.*' => [new FormDynamicRequired($this->formsDynamic)],
            // 'selectedUsers' => 'required',
            'selectedServices' => 'required',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'price' => 'required',
            'message' => 'required|min:5',
            'files.*' => 'file', // 1MB Max
            'selectedExpectedPayment' => 'required',
            'created_by' => 'required|exists:users,id',
            'selectedBudget' => 'nullable|exists:budgets,id',


        ];
    }

    public function addVisit()
    {

        $this->validate();

        if ($this->coordinateLater) {
            $this->date = null;
            $this->time = null;
        }


        // Determinar el precio y el IVA
        if ($this->selectedBudget) {
            $budget = collect($this->budgets)->firstWhere('id', $this->selectedBudget);
            $price = $budget['price'];
            $iva = $budget['iva'];




        } else {
            $price = $this->price;
            $iva = $this->checked;
        }






        $visit = $this->property->visits()->create([
            'date' => $this->date,
            'time' => $this->time,
            'price' => $price,
            'iva' => $iva,
            'status' => StatusVisitEnum::PENDING->value,
            'expected_payment' => $this->selectedExpectedPayment,
            'visit_type_id' => $this->selectedTypeVisit,
            'property_id' => $this->property->id,
            'customer_id' => $this->customer,
            'created_by' => $this->created_by,
            'duration_time' => 45,
            'budget_id' => $this->selectedBudget,
            'business_id' => auth()->user()->business->id,
        ]);



        if ($this->recommendedDate && !$this->coordinateLater && $this->routeSelected) {

            foreach ($this->routeSelected as $route) {
                $findVisit = Visit::find($route['id']);

                if ($findVisit) {
                    if (isset($route['out']) && $route['out'] == true) {
                        $findVisit->update([
                            'date' => null,
                            'time' => null,
                        ]);

                        $findVisit->users()->detach();
                    } elseif (isset($route['out']) && $route['out'] == false) {
                        $findVisit->update([
                            'date' => $route['date'],
                            'time' => $route['start_time'],
                        ]);
                    } else {
                        $findVisit->update([
                            'date' => $route['date'],
                            'time' => $route['start_time'],
                        ]);
                    }
                }
            }
        }

        if (!$this->coordinateLater) {
            if ($this->selectedUsers) {
                $visit->users()->attach(array_column($this->selectedUsers, 'id'));
            }
        }

        $visit->services()->attach(array_column($this->selectedServices, 'id'));

        foreach ($this->availabilities as $availability) {
            $visit->availabilities()->create([
                'day' => $availability['day'],
                'start_time' => $availability['start_time'],
                'end_time' => $availability['end_time']
            ]);
        }

        $comment =  $visit->comments()->create([
            'message' => $this->message,
            'user_id' => auth()->id(),
        ]);

        if ($this->formsDynamic) {
            foreach ($this->formsDynamic as $key => $form) {

                $data = [
                    'value' => $form['value'],
                ];

                $inputData = new InputData();
                $inputData->input_id = $key;
                $inputData->data = json_encode($data);
                $inputData->modeable_type = 'App\Models\Visit';
                $inputData->modeable_id = $visit->id;
                $inputData->user_id = auth()->id();
                $inputData->save();
            }
        }

        if ($this->files) {
            foreach ($this->files as $file) {
                $filename = null;
                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {

                    $filePath = Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/files/';
                    $filename = uniqid() . '.' . $file->extension();
                    $filenameComplete = $filePath . $filename;
                    $file->storeAs($filePath, $filename);
                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath);
                    $fileType = pathinfo($storedFilePath, PATHINFO_EXTENSION);
                    $fileSaved = $comment->files()->create([
                        'name' => $filename,
                        'path' => $filenameComplete,
                        'size' => $fileSize,
                        'type' => $fileType,
                        'user_id' => auth()->id(),
                    ]);
                    $file->delete();
                    Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));
                } else {

                    $filename =  Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/' . '/files/' . uniqid() . '.' . $file->extension();
                    $uploadFile = $file->getRealPath();
                    Storage::put($filename, file_get_contents($uploadFile));
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

    public function setCoordinateLater()
    {
        $this->coordinateLater = !$this->coordinateLater;
    }

    public function setRecommendedDate()
    {
        $this->recommendedDate = !$this->recommendedDate;
    }

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


    #[On('update-checked-iva')]
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
            $this->selectedExpectedPayment = $value;
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
    public function selectVisit($date, $time, $worker, $visits)
    {

        $this->selectedUsers = [];
        $this->dispatch('clear-selected-values-users')->to(MultiSelectGeneral::class);
        $this->date = Carbon::parse($date)->format('Y-m-d');
        $this->time = Carbon::parse($time)->format('H:i');
        $this->routeSelected = $visits;
        $this->dispatch('dispatch-selected-values-users', id: $worker)->to(MultiSelectGeneral::class);
    }

    #[On('update-selected-value-budget')]
    public function updateSelectedBudget($value)
    {
       
        if ($value) {
            $budget = collect($this->budgets)->firstWhere('id', $value['id']);
            if ($budget) {
                $this->price = (float) $budget['price'];
            
                $this->checked = $budget['iva'];

            }

            $this->dispatch('update-from-parent-iva', $this->checked);
            $this->dispatch('update-attribute-disabled-from-parent-iva', true);

            $this->selectedBudget = $value['id'];

        } else {
           
            $this->dispatch('update-attribute-disabled-from-parent-iva', false);
            $this->dispatch('update-from-parent-iva', false);
            $this->selectedBudget = null;
            $this->checked = false;
            $this->price = 0;

        }
    }

    #[Computed()]
    public function totalPrice()
    {
        $price = $this->price ?? 0;
        $iva = $this->checked;
     
        if ($iva && $price > 0) {
            return $price + ($price * 0.21);
        } else {
            return $price;
        }
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
