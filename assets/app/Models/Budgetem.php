<?php

namespace App\Models;

use App\Enums\OperatorBudgetemEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budgetem extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];


    public function budgets()
    {
        return $this->belongsToMany(Budget::class)->withPivot('quantity', 'total');
    }


    public function getOperatorNameAttribute()
    {
        return OperatorBudgetemEnum::fromValue($this->operator);
    }
}
