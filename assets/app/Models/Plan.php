<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Plan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];



    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_plan');
    }


    public function features(): MorphToMany
    {
        return $this->morphToMany(Feature::class, 'featureable')->wherePivot('industry_id', null)->withPivot('count');
    }
    public function featuresIndustry($industryId = null): MorphToMany
    {
        $query = $this->morphToMany(Feature::class, 'featureable');

        if ($industryId) {

            return $query->wherePivot('industry_id', $industryId);
        }

        return $query->wherePivot('industry_id', '!=', null);
    }





}
