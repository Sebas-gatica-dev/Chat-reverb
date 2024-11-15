<?php

namespace App\Models;

use App\Enums\AvailabilityDayEnums;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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


    protected function startTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }
    protected function endTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }



    public function getDays()
    {
        return AvailabilityDayEnums::getDays($this->day);
    }

}
