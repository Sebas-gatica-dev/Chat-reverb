<?php

namespace App\Models;

use App\Enums\StatusVisitEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StatusChange extends Model
{
    use HasFactory;
    use HasUuids;
    protected $guarded = [];

    protected $casts = [
        'status' => StatusVisitEnum::class
        
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function getStatus(): string
    {
        return StatusVisitEnum::getStatus($this->status);
    }


    protected function intervalStatus(): Attribute
    {
        return Attribute::make(
            get: fn ($value,$attributes) => $attributes['interval_status'] > 0 ? $attributes['interval_status'] . ' minutos'  : 'En proceso',
        );
    }


}
