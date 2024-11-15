<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;


    protected $guarded = [];



    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    //Una cuenta bancaria puede tener muchos archivos
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
    


}
