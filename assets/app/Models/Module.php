<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    use HasUuids;
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $casts = [
        'status' => 'boolean',
    ];
    protected $fillable = ['name', 'slug', 'description', 'status'];


    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_modules');
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
