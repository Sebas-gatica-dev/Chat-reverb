<?php

namespace App\Livewire\Panel\Visit\VisitStatus;

use App\Enums\FileTypeEnum;
use App\Enums\PaymentMethodEnum;
use App\Helpers\Notifications;
use App\Models\Customer;
use App\Models\Property;
use App\Models\Unit;
use App\Models\Visit;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Enums\StatusVisitEnum;
use App\Enums\Units\UnitsHistoryTypeEnum;
use App\Enums\Units\UnitsStatusEnum;
use App\Models\UnitHistory;
use App\Enums\StatusCustomerEnum;
use App\Models\InputData;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Jobs\ImageOptimizationScale;
use App\Jobs\MakeCommission;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Rules\FormDynamicRequired;

class Inprogress extends Component
{

    public Visit $visit;
    public Customer $customer;
    public Property $property;


    public $formsDynamic = [];
    public $visitCompleted;

    public $products = [];
    public $productsSelectList = [];
    public $selectedProduct;

    public $selectedWorkerUnit;
    public $worker_units = [];
    public $emptyUnit = false;
    public $previousUsedQuantity;
    public $unit_histories_use = [];


    public $useEntireUnit = false;
    public $currentQuantity;
    public $quantityToUse;
    public $quantityAfterUse;
    public $showInputEditUnitHistoryUse = false;
    public $newUnitHistortyQuantity;

    public $showUnitForm = false;
    public $showInputEdit = [];
    public $files = [];

    public $expectedPayments = [];
    public $selectedExpectedPayment;
    public $payAllTheAmount = true;
    public $amountReceived;

    public $finalComment;



    public function mount()
    {
        $this->selectedExpectedPayment = $this->visit->expected_payment->value;
        $this->amountReceived = $this->visit->iva ? $this->visit->priceIva : $this->visit->price;

        $this->expectedPayments = collect(PaymentMethodEnum::cases())->map(function ($paymentEnum) {
            return [
                'id' => $paymentEnum->value,
                'name' => $paymentEnum->getName(),
            ];
        })->toArray();

        $this->loadProducts();
    }


    public function rules(){
        return [
             'formsDynamic.*' => [new FormDynamicRequired($this->formsDynamic)],
           
          ];
     }


    public function loadProducts($order = null)
    {
        // Obtener y procesar las actividades de la visita, agrupadas por producto
        $this->unit_histories_use = $this->processVisitActivity();


        // Cargar los productos del usuario y hacer un merge con `unit_histories_use`
        $this->products = auth()->user()->products()
            ->select('products.id', 'products.name', 'products.type', 'products.quantity', 'products.unit_of_measurement', 'products.measure')
            ->get()
            ->map(function ($product) {
                // Obtener unit_histories del producto desde `unit_histories_use`, si existen
                // $unitHistories = $this->unit_histories_use[$product->id] ?? [];

                return [
                    "id" => $product->id,
                    "name" => $product->name,
                    "type" => $product->type,
                    "quantity" => $product->quantity,
                    "unit_of_measurement" => $product->unit_of_measurement,
                    "measure" => $product->measure,
                    // "unit_histories" => $unitHistories, // Merge de unit histories organizados
                ];
            })->toArray();

        $this->productsSelectList = collect($this->products)->map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'unit_of_measurement' => $product['unit_of_measurement'],
            ];
        })->toArray();
    }


    // Método `processVisitActivity` para organizar las actividades por producto y fecha
    protected function processVisitActivity()
    {
        // Obtener las actividades de la visita
        $visitActivities = json_decode($this->loadVisitActivity(), true);

        //   dd($visitActivities);

        $organizedActivities = [];


        if ($visitActivities) {
            foreach ($visitActivities as $productId => $units) {
                foreach ($units as $unitId => $activities) {
                    foreach ($activities as $key => $activity) {
                        // Agregar la actividad a la lista organizada por producto
                        $activity['showActivity'] = false;
                        $organizedActivities[$productId][$key] = $activity;
                    }
                }
            }

            // Ordenar las actividades por producto por fecha de más nuevo a más viejo
            foreach ($organizedActivities as $productId => &$activities) {
                uasort($activities, function ($a, $b) {
                    return strtotime($b['date']) <=> strtotime($a['date']);
                });
            }

            return $organizedActivities;
            // dd($organizedActivities);

            //   dd($organizedActivities);

        }
        // Iterar por cada actividad de unidad

        return $organizedActivities;
    }

    public function loadVisitActivity()
    {

        return $this->visit->visit_activity;
    }

    public function toggleEditUnitHistoryUse($productId, $unitId)
    {
        $unit = &$this->unit_histories_use[$productId][$unitId];
        $unit['showActivity'] = !$unit['showActivity'];

        if ($unit['showActivity']) {
            $this->previousUsedQuantity = $unit['quantity'];
            $unit['quantity'] = null;
        } else {
            $unit['quantity'] = $this->previousUsedQuantity;
        }
    }

    public function reloadWorkerUnits()
    {
        $this->worker_units = auth()->user()->units()
            ->where('product_id', $this->selectedProduct)
            ->where('current_quantity', '>', 0)
            ->select('id', 'tag', 'product_id', 'current_quantity')
            ->with(['product' => function ($query) {
                $query->select('id', 'name', 'unit_of_measurement');
            }])->get()
            ->map(function ($worker_unit) {
                return [
                    'id' => $worker_unit->id,
                    'name' => $worker_unit->tag . '-' . $worker_unit->product->name,
                    'current_quantity' => $worker_unit->current_quantity,
                    'unit_of_measurement' => $worker_unit->product->unit_of_measurement,
                    'status' => $worker_unit->status,
                ];
            })->toArray();
    }







    #[On('update-status')]
    public function save()
    {

        
        // dd($this->unit_histories_use);

        // $this->validate();

        //COMIENZO LOGICA DE PAGO DE VISITA

        //valido si el metodo de pago esperado es en efectivo
        if ($this->selectedExpectedPayment == 'cash') {
            // en ese caso valido si se va a pagar la cantidad completa o no.
            $this->visit->update([
                'amount_received' => $this->amountReceived,
            ]);

            //CROSSOVER CON LA BILLETERA
        }

        //FIN DE LOGICA DE PAGO DE VISITA

        //COMIENZO CREACION UNIT_HISTORY

        if ($this->unit_histories_use) {

            //quitamos la primera capa del array que continee las unidades por poroducto y nos queda un array de unidades
            $visitActivity = Arr::collapse(json_decode($this->visit->visit_activity, true));

            //mapeo de las cantidades utilizadas por unidad con clave unit_id
            $units_used = array_map(function ($activity) {
                return [
                    'total_quantity' => array_sum(array_column($activity, 'quantity')),
                    'user_id' => current(array_unique(array_column($activity, 'user_id')))
                ];
            }, $visitActivity);


            foreach ($units_used as $key => $unit_used) {

                //se guarda en una variable.

                $totalUsed = $unit_used['total_quantity'];
                $unitId = $key;
                $workerId = $unit_used['user_id'];
                //traigo el registro de la unidad
                $unit = Unit::where('id', $unitId)->first();
                //guardo en una variable la cantidad inicial de la unidad
                $initialUnitQuantity = $unit->initial_quantity;
                //guardo en una variable la cantidad actual de la unidad
                $current_quantity = $unit->current_quantity;
                //decodificar el json completo 
                $visitActivity = json_decode($this->visit->visit_activity, true);
                //hacer la suma del total de los usos que ubieron durante la visita

                // dd($totalUsed, $this->unit_histories_use,$initialUnitQuantity ,$current_quantity);
                //valido si la cantidad de actual es mayor de cero, para saber si es un unithistory de uso o dischargued  
                if ($current_quantity > 0) {

                    if ($totalUsed > $initialUnitQuantity) {
                        $this->dispatch('notification', [
                            'message' => 'Revisa tus acciones en la visita ya que pueden haber inconsistencias.',
                            'type' => Notifications::icons('error'),
                        ]);
                        return;
                    }

                    $unit->update([
                        'status' => UnitsStatusEnum::USED->value,
                    ]);

                    // Obtener el campo JSON actual y decodificarlo
                    // $visitActivity = json_decode($this->visit->visit_activity, true) ?? [];

                    UnitHistory::create([
                        'unit_id' => $unitId,
                        'type' => UnitsHistoryTypeEnum::Uso->value,
                        'originable_id' => $workerId,
                        'originable_type' => 'App\Models\User',
                        'destinationable_id' => $this->visit->id,
                        'destinationable_type' => 'App\Models\Visit',
                        'created_by' => auth()->user()->id,
                        'initial_quantity' => $initialUnitQuantity,
                        'current_quantity' => $current_quantity
                    ]);

                    // en caso de que la current quantity sea 0 debe darse de baja la unidad y generar una unithistory DISCHARGUED
                } elseif ($current_quantity == 0) {

                    $unit->update([
                        'status' => UnitsStatusEnum::DISCHARGUED->value,
                    ]);

                    //se crea primero el registro del uso.
                    UnitHistory::create([
                        'unit_id' => $unitId,
                        'type' => UnitsHistoryTypeEnum::Uso->value,
                        'originable_id' => $workerId,
                        'originable_type' => 'App\Models\User',
                        'destinationable_id' => $this->visit->id,
                        'destinationable_type' => 'App\Models\Visit',
                        'created_by' => auth()->user()->id,
                        'initial_quantity' => $initialUnitQuantity,
                        'current_quantity' => $current_quantity
                    ]);

                    //y luego el registro de que ese uso lo agoto.
                    UnitHistory::create([
                        'unit_id' => $unitId,
                        'type' => UnitsHistoryTypeEnum::Agotado->value,
                        'originable_id' => $workerId,
                        'originable_type' => 'App\Models\User',
                        'destinationable_id' => $this->visit->id,
                        'destinationable_type' => 'App\Models\Visit',
                        'created_by' => auth()->user()->id,
                        'initial_quantity' => $initialUnitQuantity,
                        'current_quantity' => $current_quantity
                    ]);
                }
            }


        }

            //FIN CREACION DE UNIT_HISTORY



            //COMIENZO LOGICA DE ESTADOS DE VISITA

            $this->visit->status = StatusVisitEnum::COMPLETED;
            $this->visit->save();

            $lastStatusChange = $this->visit->statusChanges()->where('status', StatusVisitEnum::ATTHEDOOR->value)->first();
            $createdAt = $lastStatusChange->created_at;
            $now = now();
            $intervalStatus = $now->diffInMinutes($createdAt, false);
            $intervalStatus = abs((int) $intervalStatus);
            $data = [
                'final_comment' => $this->finalComment
            ];

            $newStatusChange = $this->visit->statusChanges()->create([
                'status' => StatusVisitEnum::COMPLETED,
                // 'latitude' => $this->latitude,
                // 'longitude' => $this->longitude,
                'interval_status' => $intervalStatus,
                'data' => json_encode($data)

            ]);

            //FIN LOGICA DE ESTADOS DE VISITA


            //CREACION DEL COMENTARIO FINAL EN BADE AL TEXTAREA


            $comment = $this->visit->comments()->create([
                'message' => $this->finalComment,
                'user_id' => auth()->id(),
            ]);


            //FIN CREACION DEL COMENTARIO FINAL EN BADE AL TEXTAREA



            //INICIO FORMS DINAMICOS

            if ($this->formsDynamic) {
                foreach ($this->formsDynamic as $key => $form) {
                    $data = [
                        'value' => $form['value'],
                    ];

                    $inputData = new InputData();
                    $inputData->input_id = $key;
                    $inputData->data = json_encode($data);
                    $inputData->modeable_type = 'App\Models\StatusChange';
                    $inputData->modeable_id = $newStatusChange->id;
                    $inputData->user_id = auth()->id();
                    $inputData->save();
                }
            }

            //FIN FORMS DINAMICOS



            
            //LOGICA DE FILES
            $this->saveFiles();

            //FIN LOGICA DE FILES





            //MODIFICA EL STATUS DEL CUSTOMER 

            if ($this->visit->inspect_visit) {
                $this->property->customer->status = StatusCustomerEnum::VISITED;
                $this->property->customer->save();
            }


            MakeCommission::dispatch($this->visit);

            //logica de enviar mail notificar al cliente

            $this->dispatch('notification', [
                'message' => 'El estado de la visita se ha actualizado a "Completada".',
                'type' => Notifications::icons('success'),
            ]);

            $this->redirectRoute('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id], true, true);
   
    }



    public function updatedQuantityToUse($value)
    {

        if ($value === '' || $value === null) {
            $this->quantityToUse = null;
        } elseif ($this->selectedWorkerUnit && $value > $this->selectedWorkerUnit['current_quantity']) {

            $this->quantityToUse = $this->selectedWorkerUnit['current_quantity'];


            $this->dispatch('notification', [
                'message' => 'Si transfieres la totalidad de la unidad, esta se dará de baja',
                'type' => Notifications::icons('warning')
            ]);
        } else {
            $this->quantityToUse = $value;
        }

        $this->calculateFinalQuantities();
    }








    public function calculateFinalQuantities()
    {

        if ($this->selectedWorkerUnit) {
            $this->quantityAfterUse = $this->selectedWorkerUnit['current_quantity'] - $this->quantityToUse;
        }
    }





    public function createUnitHistoryUse()
    {

        $this->validate([
            'quantityToUse' => 'required|numeric|min:1',
        ]);

        $unit = Unit::where('id', $this->selectedWorkerUnit['id'])->first();

        if ($this->selectedWorkerUnit['current_quantity'] - $this->quantityToUse >= 0) {

            $unit->update([
                'current_quantity' => $this->quantityAfterUse,
                'status' => UnitsStatusEnum::USED->value,
            ]);

            // Obtener el campo JSON actual y decodificarlo
            $visitActivity = json_decode($this->visit->visit_activity, true) ?? [];

            // dd($visitActivity);

            $visitActivity[$this->selectedProduct['id']][$this->selectedWorkerUnit['id']][uniqid()] = [
                'user_id' => auth()->user()->id,
                'unit_id' => $this->selectedWorkerUnit['id'],
                'quantity' => $this->quantityToUse,
                'date' => now()->format('Y-m-d H:i:s'),
            ];

            // $this->showInputEdit[$this->selectedProduct['id']][$this->selectedWorkerUnit['id']] = false;

            $this->visit->update([
                'visit_activity' => json_encode($visitActivity),
            ]);

            // dd($visitActivity);

            // dd($this->unit_histories_use);

            $this->worker_units = array_map(function ($unit) {
                if ($unit['id'] === $this->selectedWorkerUnit['id']) {
                    $unit['current_quantity'] = $this->quantityAfterUse;
                }
                return $unit;
            }, $this->worker_units);

            $this->dispatch('notification', [
                'message' => 'Se ha registrado el uso de la unidad correctamente.',
                'type' => Notifications::icons('success'),
            ]);

            // $this->updateSelectedUnit($this->selectedWorkerUnit);

            $this->useEntireUnit = false;
            $this->dispatch('update-from-parent-use-entire-unit', $this->useEntireUnit);
            $this->quantityToUse = null;
            $this->quantityAfterUse = null;
            $this->selectedWorkerUnit = null;
            // $this->selectedWorkerUnit = $value;
            // $this->showUnitForm = true;

            $this->dispatch('change-selected-value-selected-unit', $this->selectedWorkerUnit);
        }

        $this->showInputEdit = [];

        foreach ($this->unit_histories_use as $product_id => $product) {


            foreach ($product as $key => $unit_history) {

                $this->showInputEdit[$product_id][$key] = false;
            }
        }

        $this->loadProducts();
        $this->reloadWorkerUnits();
        $this->dispatch('update-values-selected-unit', $this->worker_units);

        $this->mount();
    }



    public function isDischarguedUnitStatus($unitId)
    {
        $unit = Unit::find($unitId);
        if ($unit && $unit->status != UnitsStatusEnum::DISCHARGUED->value) {
            return true;
        }
        return false;
    }


    public function editUnitHistoryUse($unitHistory, $id, $unitId)
    {

        $visitActivity = json_decode($this->visit->visit_activity, true);

        //sumamos las quantitys de las unidades, osea lo usado en la visita
        // $quantitySum = array_sum(array_column($visitActivity[$id][$unitHistory['unit_id']], 'quantity'));

        if ($unitHistory) {
            // Busca el UnitHistory por su id
            $unit = Unit::find($unitHistory['unit_id']);
            $newquantity = $unitHistory['quantity'] == null ? 0 : $unitHistory['quantity'];

            $previousQuantity = $visitActivity[$id][$unitHistory['unit_id']][$unitId]['quantity'];
            $newCalculation = $unit->current_quantity + $previousQuantity - $newquantity; // aca obtenemos lo que queda de la unidad


            if ($newCalculation < 0 || $newquantity <= 0) {
                $this->dispatch('notification', [
                    'message' => 'La cantidad es mayor a lo disponible o inválida.',
                    'type' => Notifications::icons('error'),
                ]);

                return;
            }


            $unit->update([
                'current_quantity' => $newCalculation,
            ]);

            $visitActivity[$id][$unitHistory['unit_id']][$unitId]['quantity'] = $newquantity;

            $this->visit->update([
                'visit_activity' => json_encode($visitActivity),
            ]);

            $this->quantityToUse = null;
            $this->quantityAfterUse = null;
            $this->selectedWorkerUnit = null;
            $this->selectedProduct = null;
            // $this->showUnitForm = true;

            $this->dispatch('change-selected-value-selected-unit', $this->selectedWorkerUnit);
            $this->dispatch('change-selected-value-selected-product', $this->selectedProduct);


            $this->loadProducts();
            $this->reloadWorkerUnits();
        } else {
            // Maneja el caso en que no se encontró el UnitHistory
            session()->flash('error', 'No se encontró el historial de unidad especificado.');
        }
    }


    public function deleteOrCancelEditUnitHistory($unitHistory, $id, $unitId)
    {
        $unit = Unit::find($unitHistory['unit_id']);
        $visitActivity = json_decode($this->visit->visit_activity, true);

        if ($unitHistory) {

            $unit->increment('current_quantity', $unitHistory['quantity']);


            unset($visitActivity[$id][$unitHistory['unit_id']][$unitId]);

            if (empty($visitActivity[$id][$unitHistory['unit_id']])) {
                unset($visitActivity[$id][$unitHistory['unit_id']]);
            }

            if (empty($visitActivity[$id])) {
                unset($visitActivity[$id]);
            }

            if (empty($visitActivity)) {
                $visitActivity = [];
            }

            $this->visit->update([
                'visit_activity' => json_encode($visitActivity),
            ]);

            $this->dispatch('notification', [
                'message' => 'Se ha eliminado el uso de la unidad correctamente.',
                'type' => Notifications::icons('warning'),
            ]);



            $this->useEntireUnit = false;
            $this->dispatch('update-from-parent-use-entire-unit', $this->useEntireUnit);
            $this->quantityToUse = null;
            $this->quantityAfterUse = null;
            $this->selectedWorkerUnit = null;
            $this->selectedProduct = null;
            // $this->selectedWorkerUnit = $value;
            // $this->showUnitForm = true;

            $this->dispatch('change-selected-value-selected-product', $this->selectedProduct);
            $this->dispatch('change-selected-value-selected-unit', $this->selectedWorkerUnit);

            $this->loadProducts();
            $this->reloadWorkerUnits();
        }
    }



    #[On('update-selected-value-selected-product')]
    public function updateSelectedProduct($value)
    {

        $this->selectedProduct = $value;

        // dd($this->selectedProduct);
        if ($this->selectedProduct) {

            $this->worker_units = auth()->user()->units()
                ->where('product_id', $this->selectedProduct)
                ->where('current_quantity', '>', 0)
                ->select('id', 'tag', 'product_id', 'current_quantity')
                ->with(['product' => function ($query) {
                    $query->select('id', 'name', 'unit_of_measurement');
                }])->get()
                ->map(function ($worker_unit) {
                    return [
                        'id' => $worker_unit->id,
                        'name' => $worker_unit->tag . '-' . $worker_unit->product->name,
                        'current_quantity' => $worker_unit->current_quantity,
                        'unit_of_measurement' => $worker_unit->product->unit_of_measurement,
                        'status' => $worker_unit->status,
                    ];
                })->toArray();
        } else {
            $this->showUnitForm = false;
        }

        // dd($this->worker_units);
        $this->dispatch('update-values-selected-unit', $this->worker_units);
    }

    #[On('update-selected-value-selected-unit')]
    public function updateSelectedUnit($value)
    {

        // dd($value);

        if ($value) {

            if ($this->selectedWorkerUnit !== $value) {
                $this->useEntireUnit = false;
                $this->dispatch('update-from-parent-use-entire-unit', $this->useEntireUnit);
                $this->quantityToUse = null;
                $this->quantityAfterUse = null;
                $this->selectedWorkerUnit = null;
                $this->selectedWorkerUnit = $value;
                $this->showUnitForm = true;
                return;
            }

            $this->selectedWorkerUnit = $value;
            $this->showUnitForm = true;

            // $unit = Unit::where('id', $this->selectedWorkerUnit['id'])->first();

        } else {

            $this->showUnitForm = false;
            $this->quantityToUse = null;
            $this->quantityAfterUse = null;
            // $this->dispatch('change-selected-value-selected-unit', $value);
        }
    }

    #[On('update-search-selected-unit')]
    public function searchSelectedUnit($search)
    {
        $searchWorkerUnit = $search;


        $this->worker_units = auth()->user()->units()->when($searchWorkerUnit, function ($query) use ($searchWorkerUnit) {
            $query->where('tag', 'like', '%' . $searchWorkerUnit . '%');
        })->get()
            ->map(function ($worker_unit) {
                return [
                    'id' => $worker_unit->id,
                    'name' => $worker_unit->tag . '-' . $worker_unit->product->name,
                    'unit_of_measurement' => $worker_unit->product->unit_of_measurement,
                    'current_quantity' => $worker_unit->current_quantity,
                ];
            })->toArray();

        // $this->worker_units = auth()->user()->business->branches()
        //     ->when($searchBranches, function ($query) use ($searchBranches) {
        //         $query->where('name', 'like', '%' . $searchBranches . '%');
        //     })->get()->map(function ($branch) {
        //         return [
        //             'id' => $branch->id,
        //             'name' => $branch->name,
        //         ];
        //     });

        $this->dispatch('update-values-selected-unit', $this->worker_units);
    }


    // LOGICA DE LOS FILES

    #[On('change-files-visit-files')]
    public function changeFiles($values)
    {
        $this->files = [];
        $this->getFileValues($values);
    }

    #[On('remove-files-visit-files')]
    public function removeFile($values)
    {
        $this->files = [];
        $this->getFileValues($values);
    }

    protected function getFileValues($values)
    {
        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->files[] = $file;
        }
    }



    protected function saveFiles()
    {
        if ($this->files) {
            foreach ($this->files as $file) {
                $filename = null;
                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {

                    $filePath = Str::slug(auth()->user()->business->name) . '/visits/' . $this->visit->id . '/files/';
                    $filename = uniqid() . '.' . $file->extension();
                    $filenameComplete = $filePath . $filename;
                    $file->storeAs($filePath, $filename);
                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath);
                    $fileType = pathinfo($storedFilePath, PATHINFO_EXTENSION);
                    $fileSaved = $this->visit->files()->create([
                        'name' => $filename,
                        'path' => $filenameComplete,
                        'size' => $fileSize,
                        'type' => FileTypeEnum::Image->value,
                        'extension' => $fileType,
                        'user_id' => auth()->id(),
                    ]);
                    $file->delete();
                    Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));
                } else {

                    $filename =  Str::slug(auth()->user()->business->name) . '/visits/' . $this->visit->id . '/' . '/files/' . uniqid() . '.' . $file->extension();
                    $uploadFile = $file->getRealPath();
                    Storage::put($filename, file_get_contents($uploadFile));
                    $this->visit->files()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $filename,
                        'size' => $file->getSize(),
                        'type' => FileTypeEnum::Document->value,
                        'extension' => $file->extension(),
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }
    }





    // FIN DE LA LOGHICA DE LAS FILES

    #[On('update-checked-use-entire-unit')]
    public function updateUseTheEntireUnit($value)
    {


        $this->useEntireUnit = $value;


        if ($value) {


            $this->quantityToUse = $this->selectedWorkerUnit['current_quantity'];
            $this->quantityAfterUse = 0;
        } else {
            $this->quantityToUse = null;
            $this->quantityAfterUse = null;
        }
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




    #[On('update-checked-pay-all-the-amount')]
    public function updatePayAllTheAmount($value)
    {
        if ($value) {
            $this->amountReceived = $this->visit->iva ? $this->visit->priceIva : $this->visit->price;
        }

        $this->payAllTheAmount = $value;
    }


    public function render()
    {
        return view('livewire.panel.visit.visit-status.inprogress')->layout('layouts.panel');
    }
}
