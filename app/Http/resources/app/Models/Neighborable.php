<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborable extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
