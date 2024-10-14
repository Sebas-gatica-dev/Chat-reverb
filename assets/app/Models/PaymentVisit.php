<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentVisitStatusEnums;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVisit extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
        'status' => PaymentVisitStatusEnums::class
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}
