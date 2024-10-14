<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\WarehouseObserver;




#[ObservedBy([WarehouseObserver::class])]
class Warehouse extends Model
{
    /** @use HasFactory<\Database\Factories\WarehouseFactory> */
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];



    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function units(){
        return $this->hasMany(Unit::class, 'warehouse_id');
    }



}
