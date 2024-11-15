<?php

namespace App\Models;

use App\Enums\TypeContactEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadActivity extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'customer_id' => 'string',
        'user_id' => 'string',
        'date' => 'date',
        'time' => 'datetime:H:i:s',
        'is_initial' => 'boolean',
        'type_contact' => TypeContactEnum::class,
    ];

    // public $incrementing = false;
    // protected $keyType = 'string';


    //Relaciones

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
