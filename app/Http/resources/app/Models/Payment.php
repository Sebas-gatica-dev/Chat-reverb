<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected $dates = ['paid_at'];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }


    public function getStatusBadgeClass(): string
    {
        return PaymentStatusEnum::getBadge($this->status);
    }

    public function getStatusText(): string
    {
        return PaymentStatusEnum::getStatus($this->status);
    }
}
