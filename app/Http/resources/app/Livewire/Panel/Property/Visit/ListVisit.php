<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Enums\Forms\SectorTypeEnum;
use App\Enums\StatusVisitEnum;
use App\Models\Input;
use App\Models\InputData;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Product;
use App\Models\StatusChange;
use App\Models\Unit;



class ListVisit extends Component
{

    public $visit;
    public $first;
    public $principalComment;
    public array $unit_histories_use = [];
    public $visitId;

    public $visitStatus;
    public $defaultDataFields;
    public $defaultDataFieldsProblem;
    public $dataFormsDynamic = [];
    public $currentStatus;
    public $sectorList = [];
    public $statusVisitList = [];
    public $currentStatusSector;
    public $inputData;
    public $selectedSector;
    public $statusChange;

    public $statusName;

    public $hasFormDynnamic = false;
    public $modalStatusChangeData = false;

    public $worker;

    protected $statuses = [
        'pending',
        'ontheway',
        'atthedoor',
        'inprogress',
        'completed'
    ];


    public function mount($visit, $first)
    {
        $this->authorize('access-function', 'visit-list');
        $this->visit = $visit;
        $this->first = $first;

        $this->visitId = $this->visit->id;


        // $this->unit_histories_use = $this->processVisitActivity();

        $this->principalComment = $this->visit->comments->first();

        if ($this->principalComment) {
            $this->visit->comments = $this->visit->comments->where('id', '!=', $this->principalComment->id);
        }
    }


    public function processVisitActivity()
    {

        // dd('si lo toma');
        $visitActivities = json_decode($this->visit->visit_activity, true);

        $organizedActivities = [];

        //  dd($visitActivities);

        if ($visitActivities) {
            // dd($visitActivities);
            foreach ($visitActivities as $productId => $units) {
                $product = Product::where('id', $productId)->select('id','name', 'unit_of_measurement')->first()->toArray();
                $organizedActivities[$productId] = $product;
                foreach ($units as $unitId => $activities) {
                    foreach ($activities as $key => $activity) {
                        // Agregar la actividad a la lista organizada por producto

                        $unit= Unit::find($activity['unit_id']);
                        $activity['tag'] = $unit->tag;
                        $activity['showActivity'] = false;

                        // dump($activity);
                        $organizedActivities[$productId]['units'][$key] = $activity;
                    }
                }
            }



            foreach ($organizedActivities as $productId => &$activities) {



                uasort($activities['units'], function ($a, $b) {
                    return strtotime($b['date']) <=> strtotime($a['date']);
                });
            }

            $this->unit_histories_use = $organizedActivities;


            // dump($this->unit_histories_use);
 
            $this->dispatch('load-products-used-' . $this->visit->id);
        }



        //  $this->dispatch('load-products-used');
    }

    // Función para verificar si un estado es accesible
    public function isAccessible($status)
    {
        $currentStatusIndex = array_search($this->visit->status->value, $this->statuses);
        $statusIndex = array_search($status, $this->statuses);

        return $statusIndex <= $currentStatusIndex;
    }




    public function hasInputDataInfo(): bool
    {
        // Obtener los IDs de los formularios dinámicos específicos
        $formDynamicIds = Input::where('business_id', auth()->user()->business_id)
            ->where('sector', SectorTypeEnum::VisitCreate->value)
            ->pluck('id')
            ->toArray();

        // Contar los datos de entrada asociados a esos formularios dinámicos
        $inputDataCount = InputData::whereIn('input_id', $formDynamicIds)
            ->where('modeable_type', 'App\Models\Visit')
            ->where('modeable_id', $this->visit->id)
            ->count();

        return $inputDataCount > 0;
    }

    // public function openStatusChangeDataModal($status)
    // {
    //     $this->dispatch('open-status-change-data-modal-' . $this->visit->id, $status);
    // }


    public function openVisitInfoModal()
    {
        $this->dispatch('open-modal-visit-info-' . $this->visit->id);
    }



    #[On('clear-load-products-used')]
    public function clearProductsUsedList()
    {
        $this->unit_histories_use = [];
    }



    public function openShowVisitAvailabilities(){

        $this->dispatch('open-show-availabilities-modal', 'visit', $this->visit->id);
    }



    public function openStatusChangeDataModal($status)
    {
        

        // $enumCase = StatusVisitEnum::getSectorName($status);
        // $this->statusName = StatusVisitEnum::getStatus($enumCase);
        // $this->loadStatusChange($status);
        // $this->loadDataFormsDynamic($status);


        // // dd($this->statusChange,$this->dataFormsDynamic);

        // $this->modalStatusChangeData = true;

        $this->dispatch('open-status-change-data-modal',  $status, $this->visit);
        
    }

    public function loadDataFormsDynamic($status)
    {
        $this->dataFormsDynamic = Input::where('business_id', auth()->user()->business_id)
            ->where('sector', $status)
            ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
            ->orderBy('order', 'asc') // Ordenar por el campo 'order'
            ->get()->toArray();
        if ($this->dataFormsDynamic) {
            foreach ($this->dataFormsDynamic as &$input) {

                $inputData = InputData::where('input_id', $input['id'])
                    ->where('modeable_type', 'App\Models\StatusChange')
                    ->where('modeable_id', $this->statusChange->id)
                    ->get()->toArray();

                // dd($inputData);

                if ($inputData) {
                    $input['input_data'] = $inputData;
                }
            }
        }

        //  dd($this->dataFormsDynamic);
    }

    public function loadStatusChange($status)
    {
        $enumCase = StatusVisitEnum::getSectorName($status);
        // dd($enumCase);
        $this->statusChange = StatusChange::where('visit_id', $this->visit->id)
            ->where('status', $enumCase->value)
            ->first();
        //  dd($this->statusChange);
        if (!is_null($this->statusChange->data)) {

            $defaultFieldsData = json_decode($this->statusChange->data, true);


            $this->defaultDataFields = $defaultFieldsData;
        }
    }




    #[On('restore-visit-to-pending')]
    public function restoreVisitToPending()
    {
        // Eliminar todos los statusChanges relacionados a la visita
        StatusChange::where('visit_id', $this->visit->id)->delete();

        // Restaurar el estado de la visita a pendiente
        $this->visit->status = StatusVisitEnum::PENDING;
        $this->visit->save();
    }









    public function render()
    {
        return view('livewire.panel.property.visit.list-visit');
    }
}
