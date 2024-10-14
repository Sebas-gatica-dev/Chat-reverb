<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable')->orderBy('order', 'asc');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function business ()
    {
        return $this->belongsTo(Business::class);
    }

    public function lastVisit()
    {
        return $this->hasMany(Visit::class)->latest();
    }

}
