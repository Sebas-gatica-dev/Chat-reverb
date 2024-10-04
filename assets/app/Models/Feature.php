<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];


    // protected function casts(): array
    // {
    //     return [
    //         'id' => 'integer',
    //     ];
    // }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // public function plans()
    // {
    //     return $this->belongsToMany(Plan::class, 'plan_features');

    // }


    public function plans(): MorphToMany
    {
        return $this->morphedByMany(Plan::class, 'featureable');
    }



    // public function industries(): MorphToMany
    // {
    //     return $this->morphedByMany(Industry::class, 'featureable');
    // }

    public function businesses(): MorphToMany
    {
        return $this->morphedByMany(Business::class, 'featureable');
    }


    public function industries()
    {
        return $this->morphedByMany(Plan::class, 'featureable')->withPivot('industry_id');
    }


    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    public function roles()
    {
        return $this->morphedByMany(Role::class, 'featureable')->withPivot('count');
    }




}
