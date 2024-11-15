<?php

namespace App\Models;

use App\Enums\TypeBudgetemEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PdfResource extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];



    public function budgets()
    {
        return $this->morphedByMany(Budget::class, 'budgetable', 'budget_pdf_resource', 'budgetable_id', 'pdf_resource_id')
            ->withPivot('order')
            ->withTimestamps();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function budgetTemplates()
    {
        return $this->morphedByMany(
            BudgetTemplate::class,
            'budgetable',
            'budget_pdf_resource',
            'pdf_resource_id',
            'budgetable_id'
        )->withPivot('order')->withTimestamps();
    }
}
