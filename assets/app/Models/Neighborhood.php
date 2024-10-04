<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city_id'];

    public function subzones()
    {
        return $this->hasMany(Subzone::class);
    }
}
