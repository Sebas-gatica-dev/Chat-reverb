<?php

namespace App\Models;

use App\Enums\AvailabilityDayEnums;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    protected $casts = ['day' => AvailabilityDayEnums::class];

    public function visits()
    {
        return $this->morphToMany(Visit::class, 'availabilitable');
    }

    public function property()
    {
        return $this->morphToMany(Property::class, 'availabilitable');
    }



    public function getDays()
    {
        return AvailabilityDayEnums::getDays($this->day);
    }

}
