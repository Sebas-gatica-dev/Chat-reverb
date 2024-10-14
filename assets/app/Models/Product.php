<?php

namespace App\Models;

use App\Enums\ProductTypeEnum;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];


    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    
    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }


  
    public function getTypeText(): string
    {
        return ProductTypeEnum::getType($this->type);
    }
    

}
