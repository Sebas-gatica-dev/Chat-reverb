<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\SourceEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $casts = [
        'status' => StatusCustomerEnum::class,
        'type_contact' => TypeContactEnum::class,
        'source' => SourceEnum::class,
        'gender' => GenderEnum::class
    ];


    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function budget()
    {
        return $this->hasOne(Budget::class)->orderBy('created_at', 'asc');
    }

    



    public function getFullNameAttribute()
    {
        return trim("{$this->name} {$this->surname}");
    }


    public function leadActivities()
    {
        return $this->hasMany(LeadActivity::class)->orderBy('date', 'desc')->orderBy('time');
    }


    public function leadFirstActivity(){

        return $this->hasOne(LeadActivity::class)->orderBy('date', 'asc')->orderBy('time');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable')->orderBy('order', 'asc');
    }


    public function firstPhone()
    {
        return $this->morphOne(Phone::class, 'phoneable')->orderBy('order', 'asc');
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

    public function firstProperty()
    {
        return $this->hasOne(Property::class)->orderBy('created_at', 'asc');
    }

    public function activities()
    {
        return $this->hasMany(LeadActivity::class)->orderBy('date', 'desc')->orderBy('time');
    }
}
