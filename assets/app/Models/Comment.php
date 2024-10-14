<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function visits()
    {
        return $this->morphMany(Visit::class, 'commentable');
    }



    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
