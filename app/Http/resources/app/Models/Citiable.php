<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citiable extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
