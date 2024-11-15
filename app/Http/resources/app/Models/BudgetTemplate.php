<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetTemplate extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;


    protected $guarded = [];


    public function budgetems()
    {
        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->orderByPivot('order');
    }





    public function privateBudgetems()
    {
        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->wherePivot('private', true)
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->withTrashed()
            ->orderByPivot('order');
    }


    public function publicBudgetems()
    {
        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->wherePivot('private', false)
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->orderByPivot('order');
    }


    public function products()
    {
        return $this->morphToMany(Product::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->wherePivot('private', false)
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->orderByPivot('order');
    }


    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    // public function itemsProducts()
    // {
    //     return $this->morphMany(Product::class, 'itemable');
    // }



    public function pdfResources()
    {
        return $this->morphToMany(PdfResource::class, 'budgetable', 'budget_pdf_resource', 'budgetable_id', 'pdf_resource_id')
            ->withPivot('order', 'pdf_resource_id')
            ->withTimestamps();
    }
}
