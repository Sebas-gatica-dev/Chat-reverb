<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Forms\InputTypeEnum;
use App\Enums\Forms\SectorTypeEnum;
use Illuminate\Database\Eloquent\SoftDeletes;


class Input extends Model
{
    /** @use HasFactory<\Database\Factories\InputFactory> */
   use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'input_type' => InputTypeEnum::class,
        'sector' => SectorTypeEnum::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function input()
    {
        return $this->belongsTo(Input::class);
    }

 
    public function inputData()
    {
        return $this->morphMany(InputData::class, 'modelable');
    }



}
