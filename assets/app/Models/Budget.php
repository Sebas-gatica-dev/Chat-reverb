<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];



    public function budgetems(){
        return $this->belongsToMany(Budgetem::class);
    }
    
}
