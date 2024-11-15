<?php

namespace App\Models;

use App\Enums\TypeBudgetemEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budgetem extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'budgetems';



    protected $guarded = [];


    protected $casts = [
        'type' => TypeBudgetemEnum::class,
    ];


    public function budgets()
    {

        return $this->morphedByMany(Budget::class, 'itemable', 'budget_budgetem', 'itemable_id', 'budgetable_id')
;
    }
    

    // Relación polimórfica con plantillas de presupuestos (BudgetTemplate)
    public function budgetTemplates()
    {
        return $this->morphedByMany(BudgetTemplate::class, 'budgetable', 'budget_budgetem', 'budgetable_id', 'budgetable_type')
            ->withPivot('quantity', 'total', 'value', 'order', 'visible_doc', 'private')
            ->withTimestamps();
    }





}
