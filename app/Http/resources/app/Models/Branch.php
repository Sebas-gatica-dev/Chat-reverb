<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $guarded = [];

    //Crear la relacion de muchos a muchos con usuarios
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function bankAccounts()
    {
        return $this->belongsToMany(BankAccount::class);
    }

    public function requestPayments()
    {
        return $this->hasMany(RequestPayment::class);
    }

}
