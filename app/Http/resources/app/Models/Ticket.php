<?php

namespace App\Models;

use App\Enums\Tickets\StatusTicketEnum;
use App\Enums\Tickets\TypeTicketEnum;
use App\Observers\TicketObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


#[ObservedBy([TicketObserver::class])]
class Ticket extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];

    protected $casts = [
        'status' => StatusTicketEnum::class,
        'type' => TypeTicketEnum::class,
    ];

    //Relaciones


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function offeredBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }


    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }


    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getProofUrl($value),
        );
    }

    private function getProofUrl($value)
    {
        if (!$value || filter_var($value, FILTER_VALIDATE_URL)) {
            return 'https://placehold.co/400';
        }

        // Si el valor no es un enlace, se asume que es un path
        return asset('storage/' . $value);
    }

}



