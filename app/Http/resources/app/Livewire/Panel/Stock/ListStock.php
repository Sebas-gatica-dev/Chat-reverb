<?php

namespace App\Livewire\Panel\Stock;

use App\Models\Business;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Enums\ProductTypeEnum;
use Livewire\WithPagination;


class ListStock extends Component
{
  use WithPagination;

  public $selectedProducts = [];
  public $business;
  public $hasProductsWithoutUnits;
  public $selectProductTypes = [];
  public $selectedProductType;
  public $sort;
  public $searchTerm = '';




  public function mount()
{
    $this->business = auth()->user()->business;
    
    $this->selectProductTypes = collect(ProductTypeEnum::cases())->map(function($selectedProductType){
      return [
        'id' => $selectedProductType->value,
        'name' => ProductTypeEnum::getType($selectedProductType->value),

      ];

    })->toArray();

    //  dd($this->selectProductTypes);

    $this->hasProductsWithoutUnits = !empty(Product::where('business_id', auth()->user()->business->id)
    ->whereDoesntHave('units')
    ->get()
    ->toArray());

    

    // dd(Product::whereHas('units')
    // ->where('business_id', $this->business->id)
    // ->orderBy('created_at', 'desc')
    // ->paginate(10));
    // dd($this->business->id);

    // $this->products = Product::whereHas('units')
    //                          ->where('business_id', $this->business->id)
    //                          ->get();

    // dd(Product::where());

}



#[On('update-selected-value-productType')]
public function updateSelectedZone($value)
{
    $this->selectedProductType = $value;
  
}



public function updateSort($sort)
{
    $this->sort = $sort;

    $this->resetPage();
}


    public function render()
    {
        $business = auth()->user()->business;
    
        $productsQuery = Product::where('business_id', $business->id)->select([
            'id',
            'name',
            'quantity',
            'cost',
            'profit',
            'type',
            'created_at',
            
        ])->whereHas('units') 
            ->when($this->selectedProductType, function ($query) {
                $query->where('type', $this->selectedProductType);
            })
            ->when($this->searchTerm, function ($query) {
                $searchTerm = '%' . $this->searchTerm . '%';
                $query->where('name', 'like', $searchTerm); 
            })
            ->orderBy('quantity', $this->sort === 'menos' ? 'asc' : 'desc'); 
    
        $products = $productsQuery->paginate(10);
        // dd($products);
    
        return view('livewire.panel.stock.list-stock', [
            'products' => $products,
        ])->layout('layouts.panel');
    }

}
