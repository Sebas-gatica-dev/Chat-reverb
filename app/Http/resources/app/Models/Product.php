<?php

namespace App\Models;

use App\Enums\ProductTypeEnum;
use App\Enums\Units\UnitsHistoryTypeEnum;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;


#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    // protected $casts = [
    //     'type' => ProductTypeEnum::class,
    // ];

    public function units()
    {
        return $this->hasMany(Unit::class);
    }


    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }


    public function getAllUnitHistories()
    {
        return $this->units()->with('unit_histories')->get()->pluck('unit_histories')->flatten();
    }

    public function getUnitHistoryUsed($id = null)
    {
     
       $unitsCollect = $this->units()
       ->where('worker_id', auth()->user()->id)
       ->with(['unit_histories' => function ($query) use ($id) {
        $query->where('type', '=', UnitsHistoryTypeEnum::Uso->value);
        if ($id !== null) {
            $query->where('destinationable_id', '=', $id);
        }
        }])->get()->pluck('unit_histories')->flatten()->toArray();

        // $unitsCollect = UnitHistory::with(['unit.product' => function ($query) {
        //     $query->select('id', 'name');
        // }])
        //     ->where('originable_id', auth()->user()->id)
        //     ->where('type', UnitsHistoryTypeEnum::Uso->value)
        //     ->where('originable_type', 'App\Models\User')
        //     ->where('destinationable_id', $id)
        //     ->where('destinationable_type', 'App\Models\Visit')
        //     ->get()->toArray();

        return collect($unitsCollect)->mapWithKeys(function ($item) {
            return [$item['id'] => $item];
        });

    }



    public function getTypeText(): string
    {
        return ProductTypeEnum::getType($this->type);
    }





    public function budgets() // inversa puesta por gpt
    {
        return $this->morphedByMany(Budget::class, 'itemable', 'budget_budgetem', 'itemable_id', 'itemable_type')
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private')
            ->withTimestamps();
    }

    public function budgetTemplates()
    {
        return $this->morphedByMany(BudgetTemplate::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'budgetable_type')
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private')
            ->withTimestamps();
    }



}
