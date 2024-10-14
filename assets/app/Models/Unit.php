<?php

namespace App\Models;

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
        return $this->belongsTo(User::class,'user_id');
    }


}