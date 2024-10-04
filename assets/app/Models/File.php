<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getFileUrl($value),
        );
    }

    private function getFileUrl($value)
    {
        if (!$value) {
            return 'https://placehold.co/400';
        }

        // Si el valor es un enlace completo
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // Si el valor no es un enlace, se asume que es un path
        return asset('storage/' . $value);
    }

    public function fileable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function properties()
    {
        return $this->morphedByMany(Property::class, 'fileable');
    }


    public function bank_accounts()
    {
        return $this->morphedByMany(BankAccount::class, 'fileable');
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }


}
