<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;


    protected $guarded = [];

    public function features()
    {
        return $this->morphToMany(Feature::class, 'featureable');
    }

    // public function industriesFeatures()
    // {
    //     return $this->morphMany(Feature::class, 'featureable');
    // }

    public function detachFeatures(array $featureIds)
    {
        $this->features()->detach($featureIds);
    }










    public function businesses()
    {
        return $this->hasMany(Business::class);
    }


}
