<?php

namespace App\Livewire\Panel\Stock;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class ListStockInventory extends Component
{
    use WithPagination;

    public ?Product $product;
    public $tags;
    public $batches;
    public $startEntryDateRange;
    public $endEntryDateRange;
    public $startExpirationDateRange;
    public $endExpirationDateRange;
    public $listStatus;
    public $currentOriginable;
    public $sort = 'newest';
    public $countFilters;
    public $searchTerm;
    public function mount()
    {
    }










    public function updateCountFilters()
    {
        $this->countFilters = 0;

        if ($this->tags) $this->countFilters++;
        if ($this->batches) $this->countFilters++;
        if ($this->startEntryDateRange && $this->endEntryDateRange) $this->countFilters++;
        if ($this->startExpirationDateRange && $this->endExpirationDateRange) $this->countFilters++;
        if ($this->listStatus) $this->countFilters++;
        if ($this->currentOriginable) $this->countFilters++;
        if ($this->searchTerm) $this->countFilters++;
    }


    public function resetFilters()
    {
        $this->tags = null;
        $this->batches = null;
        $this->startEntryDateRange = null;
        $this->endEntryDateRange = null;
        $this->startExpirationDateRange = null;
        $this->endExpirationDateRange = null;
        $this->listStatus = null;
        $this->currentOriginable = null;
        $this->searchTerm = null;
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


    public function render()
    {

        $units = $this->product->units()->paginate(10);

        // dd($units);

        return view('livewire.panel.stock.list-stock-inventory', compact('units'))->layout('layouts.panel');
    }
}