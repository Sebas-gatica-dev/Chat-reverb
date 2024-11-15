<?php

namespace App\Models;

use App\Enums\RequestPayment\ReceiptTypeEnum;
use App\Enums\Tickets\StatusTicketEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Receipt extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $table = 'receipts';

    protected $guarded = [];

    protected $casts = [
        'status' => StatusTicketEnum::class,
        'type' => ReceiptTypeEnum::class,
    ];

    /**
     * Relationship with RequestPayment.
     */
    public function requestPayment()
    {
        return $this->belongsTo(RequestPayment::class);
    }


    /**
     * Relationship with the creator (User).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
