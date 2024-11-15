<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinceable extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function province()
    {
        return $this->belongsTo(Province::class);
    }


}
