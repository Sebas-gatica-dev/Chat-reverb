<?php

namespace App\Models;

use App\Enums\StatusVisitEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusChange extends Model
{
    use HasFactory;
    use HasUuids;
    protected $guarded = [];

    protected $casts = ['status' => StatusVisitEnum::class];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function getStatus(): string
    {
        return StatusVisitEnum::getStatus($this->status);
    }


}
