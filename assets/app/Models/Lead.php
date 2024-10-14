<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    // Relationships
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subzone()
    {
        return $this->belongsTo(Subzone::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return trim("{$this->name} {$this->surname}");
    }

    public function getStatusBadgeClassesAttribute()
    {
        $badges = [
            'En proceso' => 'bg-yellow-100 text-yellow-800',
            'Presupuestado' => 'bg-blue-100 text-blue-700',
            'A visitar' => 'bg-indigo-100 text-indigo-700',
            'Concretado' => 'bg-green-100 text-green-700',
            'No concretado' => 'bg-red-100 text-red-700',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-600';
    }


    public function getStatusBadgeFillClassesAttribute()
    {

        $badges = [
            'En proceso' => 'fill-yellow-500',
            'Presupuestado' => 'fill-blue-500',
            'A visitar' => 'fill-indigo-500',
            'Concretado' => 'fill-green-500',
            'No concretado' => 'fill-red-500',
        ];

        return $badges[$this->status] ?? 'fill-gray-400';
    }







    public function getContactBadgeClassesAttribute()
    {
        $badges = [
            'Llamado telefónico' => 'bg-green-100 text-green-700',
            'Email' => 'bg-blue-100 text-blue-700',
            'Whatsapp' => 'bg-green-100 text-green-700',
            'Presencial' => 'bg-purple-100 text-purple-700',
            'Otro' => 'bg-gray-100 text-gray-600',
        ];

        return $badges[$this->type_contact] ?? 'bg-gray-100 text-gray-600';
    }



    public function getContactBadgeFillClassesAttribute()
    {
        $badges = [
            'Llamado telefónico' => 'fill-green-500',
            'Email' => 'fill-blue-500',
            'Whatsapp' => 'fill-green-500',
            'Presencial' => 'fill-purple-500',
            'Otro' => 'fill-gray-400',
        ];

        return $badges[$this->type_contact] ?? 'fill-gray-400';
    }

    // In app/Models/Lead.php

    public function budget()
    {
        return $this->morphOne(Budget::class, 'budgetable');
    }
}
