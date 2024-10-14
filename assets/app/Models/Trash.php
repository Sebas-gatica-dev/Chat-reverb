<?php

namespace App\Models;

use App\Enums\ModelTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trash extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function trashable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
