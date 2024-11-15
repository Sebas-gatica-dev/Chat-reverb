<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InputData extends Model
{
    /** @use HasFactory<\Database\Factories\InputDataFactory> */
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected $casts = [
        'json' => 'data',
        
    ];



    public function input()
    {
        return $this->belongsTo(Input::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }









    
}
