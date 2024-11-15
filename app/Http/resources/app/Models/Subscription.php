<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, HasUuids;

    protected $casts = ['status' => SubscriptionStatus::class];
    protected $guarded = [];
    protected $dates = ['starts_at', 'trial_ends_at', 'ends_at', 'canceled_at'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isActive()
    {
        return $this->status == 1 && (!$this->ends_at || $this->asDate($this->ends_at)->isFuture());
    }

    public function isExpired()
    {
        return $this->ends_at && $this->asDate($this->ends_at)->isPast();
    }

    public function isWithinTolerancePeriod()
    {
        return $this->ends_at && $this->asDate($this->ends_at)->isPast() && $this->asDate($this->ends_at)->diffInDays(now()) <= 3;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function paymentPending()
    {
        return $this->hasOne(Payment::class)->whereNot('status', 1)->latest('created_at');
    }

    public function asDate($value)
    {
        return $value instanceof Carbon ? $value : Carbon::parse($value);
    }


    public function getStatusText(): string
    {
        return SubscriptionStatus::getStatus($this->status);
    }

    public function getStatusBadgeClass(): string
    {
        return SubscriptionStatus::getBadge($this->status);
    }

    public function getStatusExpandClass(): string
    {
        return SubscriptionStatus::getExpand($this->status);
    }
}
