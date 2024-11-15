<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subzonable extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subzone()
    {
        return $this->belongsTo(Subzone::class);
    }
}
