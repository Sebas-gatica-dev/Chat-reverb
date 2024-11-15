<?php

namespace App\Livewire\Panel\Stock;

use App\Enums\Units\UnitsStatusEnum;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Enums\Units\UnitStatusEnum;
use App\Models\User;
use App\Models\Warehouse;




class ListStockInventory extends Component
{
    use WithPagination;

    public ?Product $product;
    public array $tags = [];
    #[Url(as: 'tag')]
    public $selectedTag;
    public array $batches = [];
    #[Url(as: 'startEntryDate')]
    public $startEntryDateRange;
    #[Url(as: 'endEntryDate')]
    public $endEntryDateRange;
    #[Url(as: 'startExpirationDate')]
    public $startExpirationDateRange;
    #[Url(as: 'endExpirationDate')]
    public $endExpirationDateRange;
    public $listStatus;
    #[Url(as: 'status')]
    public $selectedStatus;
    public $currentOriginable;
    #[Url(as: 'order')]
    public $sort = 'newest';
    public $countFilters;
    #[Url(as: 'search')]
    public $searchTerm = '';
    public $unitsHasWorker = false;
    public $unitsHasWareHouse = false;
    public $selectUnitUbication =[];  
    public $searchUnitUbication = '';
    #[Url(as: 'unitUbication')]
    public $selectedUnitUbication;
    


    public function mount()
    {

    
        $this->changeUnitUbications();

        $this->countFilters = 0;
        $this->batches = $this->product->units()->select('id', 'batch')->get()->toArray();;
        $this->listStatus = collect(UnitsStatusEnum::cases())->map(function ($status) {
            return [
                'id' => $status->value,
                'name' => UnitsStatusEnum::getStatus($status->value),
            ];
        })->toArray();

      
    }

    public function updateCountFilters()
    {
        $this->countFilters = 0;
  
        // if ($this->tags) $this->countFilters++;
        if ($this->searchTerm) $this->countFilters++;
        if ($this->startEntryDateRange && $this->endEntryDateRange) $this->countFilters++;
        if ($this->startExpirationDateRange && $this->endExpirationDateRange) $this->countFilters++;
        if ($this->selectedStatus) $this->countFilters++;
        if($this->selectedUnitUbication) $this->countFilters++;
    }

    public function resetFilters()
    {
       
        $this->searchTerm = '';
        $this->startEntryDateRange = null;
        $this->endEntryDateRange = null;
        $this->startExpirationDateRange = null;
        $this->endExpirationDateRange = null; 
        $this->dispatch('clear-selected-value-unitStatus', intval($this->selectedStatus) );
        $this->selectedStatus = null;
        // $this->dispatch('clear-selected-value-unitUbication', null);
        $this->selectedUnitUbication=null;
        $this->updateCountFilters();
        $this->resetPage();
    }


    public function updateSort($sort)
    {
        $this->sort = $sort;
        $this->resetPage();
    }

    #[On('update-selected-value-unitStatus')]
    public function updateSelectedStatus($value)
    {
        if($value){

            $this->selectedStatus = strval($value);


        }else{
            $this->selectedStatus = null;
        }
  
      

        // dd($this->selectedStatus );


        $this->updateCountFilters();
        $this->resetPage();

    }

    #[On('set-date-range-entryDate')]
    public function setEntryDateRange($startDate, $endDate)
    {

        $this->startEntryDateRange = $startDate;
        $this->endEntryDateRange = $endDate;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('set-date-range-expirationDate')]
    public function setExpirationDateRange($startDate, $endDate)
    {

        $this->startExpirationDateRange = $startDate;
        $this->endExpirationDateRange = $endDate;
        $this->updateCountFilters();
        $this->resetPage();
    }


    #[On('update-selected-value-unitUbication')]
    public function updateSelectedUnitUnication($value)
    {
        // dump($value);
        if($value){
            $this->selectedUnitUbication = $value;

        }else{
            $this->selectedUnitUbication = null;
        }
        
        $this->updateCountFilters();
        $this->resetPage();
    }


    
    #[On('update-search-unitUbication')]
    public function updateSearchUnitUbication($search)
    {

        $this->searchUnitUbication = $search;

        $this->changeUnitUbications();
        $this->resetPage();
    }


    public function changeUnitUbications()
    {
       // Búsqueda de usuarios
    $users = User::where('business_id', auth()->user()->business->id)->when($this->searchUnitUbication, function ($query) {
        $query->where('name', 'like', '%' . $this->searchUnitUbication . '%');
    })
    ->limit(3)
    ->get()
    ->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'model' => 'Usuario',
        ];
    });

    

    // Búsqueda de almacenes
    $warehouses = Warehouse::where('business_id', auth()->user()->business->id)->when($this->searchUnitUbication, function ($query) {
        $query->where('name', 'like', '%' . $this->searchUnitUbication . '%');
    })
    ->limit(3)
    ->get()
    ->map(function ($warehouse) {
        return [
            'id' => $warehouse->id,
            'name' => $warehouse->name,
            'model' => 'Deposito',
        ];
    });

        $this->selectUnitUbication = collect($users)->merge($warehouses);

        $this->dispatch('update-values-unitUbication', $this->selectUnitUbication);
    }

    protected function applyFilters($query)
    {
        // Filtro por ubicación de unidad
        $query->when($this->selectedUnitUbication, function ($query) {
            $selectedUbication = $this->selectedUnitUbication;
            $model = $selectedUbication['model'];
            $id = $selectedUbication['id'];
    
            $query->where(function ($query) use ($model, $id) {
                if ($model === 'Usuario') {
                    $query->where('worker_id', $id);
                } elseif ($model === 'Deposito') {
                    $query->where('warehouse_id', $id);
                } 
            });
        })
        ->when($this->selectedStatus, function ($query) {
            $query->where('status', $this->selectedStatus);
        })
        ->when($this->startEntryDateRange && $this->endEntryDateRange, function ($query) {
            $query->whereBetween('entry_date', [$this->startEntryDateRange, $this->endEntryDateRange]);
        })
        ->when($this->startExpirationDateRange && $this->endExpirationDateRange, function ($query) {
            $query->whereBetween('expiration_date', [$this->startExpirationDateRange, $this->endExpirationDateRange]);
        });
    
        return $query;
    }
    

    public function render()
    {
        // $units = $this->product->units()->paginate(10);
        $query = $this->product->units()->select('id','tag', 'cost','profit_margin', 'batch', 'type', 'expiration_date', 'product_id', 'warehouse_id', 'entry_date', 'created_by', 'weight', 'worker_id', 'initial_quantity', 
        'current_quantity', 'status'
        )->with([
            'product' => function ($query) {
                $query->select('id', 'unit_of_measurement');
            },
            'warehouse' => function ($query) {
                $query->select('id', 'name');
            },
            'unit_histories' => function ($query) {
                $query->select('id', 'originable_type', 'originable_id', 'destinationable_type', 'destinationable_id', 'created_by', 'created_at', 'type');
            },
            'worker' => function ($query) {
                $query->select('id', 'name');
            },
        ]);

        $query = $this->applyFilters($query);
        
        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('tag', 'like', $searchTerm)
                    ->orWhere('batch', 'like', $searchTerm);    
            });
        }

    
        $query = $query->orderBy('created_at', $this->sort === 'newest' ? 'desc' : 'asc');


        $units = $query->paginate(10);



        return view('livewire.panel.stock.list-stock-inventory', compact('units'))->layout('layouts.panel');
    }
}
