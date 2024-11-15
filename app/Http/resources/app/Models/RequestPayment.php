<?php

namespace App\Models;

use App\Enums\RequestPayment\StatusRequestPaymentEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RequestPayment extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $table = 'request_payments';
    protected $guarded = [];

    protected $casts = [
        'status' => StatusRequestPaymentEnum::class,
    ];


    /**
     * Polymorphic relationship to the parent model (Visit or GroupRequestPayment).
     */
    public function referenceable()
    {
        return $this->morphTo();
    }

    /**
     * Relationship with Receipts.
     */
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    /**
     * Relationship with the creator (User).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


}
