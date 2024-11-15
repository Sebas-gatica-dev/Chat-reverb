<?php

namespace App\Models;

use App\Enums\Units\UnitMeditionTypeEnum;
use App\Enums\Units\UnitsHistoryTypeEnum;
use App\Enums\Units\UnitsStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\UnitObserver;

#[ObservedBy([UnitObserver::class])]
class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status' => UnitsStatusEnum::class,
    ];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse_id'); 
    }


    public function unit_histories(){
        return $this->hasMany(UnitHistory::class);
    }



    public function product(){
        return $this->belongsTo(Product::class);
    }


    public function worker(){
        return $this->belongsTo(User::class,'worker_id');
    }


    public function getUnitHistoryUsed()
    {
        return $this->unit_histories()->where('type', '=', UnitsHistoryTypeEnum::Uso->value)->get();
    }




}