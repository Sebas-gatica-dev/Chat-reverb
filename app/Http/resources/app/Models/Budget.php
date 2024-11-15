<?php

namespace App\Models;

use App\Enums\StatusBudgetEnum;
use App\Enums\TypeBudgetemEnum;
use App\Observers\BudgetObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


#[ObservedBy([BudgetObserver::class])]
class Budget extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $table = 'budgets';

    protected $casts = [
        'status' => StatusBudgetEnum::class,
    ];

    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        // Antes de crear el presupuesto, asignar un número incremental
        static::creating(function ($budget) {

            $latestBudget = Budget::where('business_id', $budget->business_id)->latest()->first();

            if ($latestBudget) {
                $budget->code = $latestBudget->code + 1;
            } else {
                $budget->code = 1;
            }
        });
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }



    public function visits()
    {
        return $this->hasMany(Visit::class);
    }



    public function property()
{
    return $this->belongsTo(Property::class);
}


    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function budgetems()
    {

        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->orderByPivot('order');
    }

        /**
     * Relación para obtener las variables (Budgetem) asociadas al presupuesto.
     */

    public function publicVisibleBudgetems()
    {
        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->wherePivot('visible_doc', true)
            ->wherePivot('private', false)
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->orderByPivot('order');
    }


    public function publicVisibleProducts()
    {
        return $this->morphToMany(Product::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->wherePivot('visible_doc', true)
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'itemable_type')
            ->orderByPivot('order');
    }





    public function publicInvisibleBudgetems()
    {
        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private', 'itemable_type')
            ->where(function ($query) {
                $query->where('budget_budgetem.private', true)
                    ->orWhere('budget_budgetem.visible_doc', false);
                // Puedes agregar condiciones adicionales aquí si es necesario
            })
            ->orderBy('budget_budgetem.order');
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
        return $this->morphToMany(Budgetem::class, 'budgetable', 'budget_budgetem', 'budgetable_id',  'itemable_id')
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

    public function publicInvisibleProducts(){

        return $this->morphToMany(Product::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'itemable_id')
            ->wherePivot('visible_doc', false)
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'itemable_type')
            ->orderByPivot('order');
    }


    public function pdfResources()
    {
        return $this->morphToMany(PdfResource::class, 'budgetable', 'budget_pdf_resource', 'budgetable_id', 'pdf_resource_id')
            ->withPivot('order', 'pdf_resource_id')
            ->withTimestamps();
    }


    public function getPdfFilePath()
    {


        $businessSlug = Str::slug($this->business->name);
        $pdfFileName =  Str::slug($this->name) .'-'. Str::slug($this->id) . '.pdf';

        // dd($this->id);
        // dd($businessSlug . '/budgets/' . $pdfFileName);
        return $businessSlug . '/budgets/' . $pdfFileName;
    }

    public function pdfExists()
    {
        return Storage::exists($this->getPdfFilePath());
    }

    public function getPdfUrl()
    {

        return Storage::url($this->getPdfFilePath());
    }
}
