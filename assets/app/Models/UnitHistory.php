<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;


class UnitHistory extends Model
{
    /** @use HasFactory<\Database\Factories\UnitsHistoryFactory> */
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];


       public function unit(){
         return $this->belongsTo( Unit::class, 'unit_id');
       }


        // Relación polimórfica para el "desde" (origen)
        public function desde()
        {
            return $this->morphTo();
        }
    
        // Relación polimórfica para el "hasta" (destino)
        public function hasta()
        {
            return $this->morphTo();
        }



}
