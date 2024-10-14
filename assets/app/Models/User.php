<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\TransportEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $keyType = 'string';

    protected $casts = ['transport' => TransportEnum::class];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }

    // public function branches()
    // {
    //     return $this->hasMany(Branch::class);
    // }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function rolesCreated()
    {
        return $this->hasMany(Role::class, 'created_by');
    }

    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'user_visit');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function availabilities()
    {
        return $this->morphMany(Availability::class, 'availabilitable');
    }

    public function specialAvailabilities()
    {
        return $this->morphMany(SpecialAvailability::class, 'available');
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getPhotoUrl($value),
        );
    }

    private function getPhotoUrl($value)
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


    public function countries()
    {
        return $this->morphMany(Countriable::class, 'countriable');
    }

    public function provinces()
    {
        return $this->morphMany(Provinceable::class, 'provinceable');
    }

    public function cities()
    {
        return $this->morphMany(Citiable::class, 'citiable');
    }

    public function neighborhoods()
    {
        return $this->morphMany(Neighborable::class, 'neighborable');
    }

    public function subzones()
    {
        return $this->morphMany(Subzonable::class, 'subzonable');
    }


    public function templates()
    {
        return $this->morphToMany(Template::class, 'templateable');
    }


    // PRUEBA DE ORGANIZADOR DE VISITAS

    public function worksInZone($property)
    {
        if(is_array($property)){
            $property = new Property($property);
            $property->exists = true;
        }
        

       // dd($property);
        // Verificar si el operario trabaja en la misma provincia
        if ($property->province_id && !$this->provinces->contains('province_id', $property->province_id)) {


            return false;

        }

        // Verificar si el operario trabaja en la misma ciudad
        if ($property->city_id && !$this->cities->contains('city_id', $property->city_id)) {
            return false;
        }

        // Verificar si el operario trabaja en el mismo vecindario
        if ($property->neighborhood_id && !$this->neighborhoods->contains('neighborhood_id', $property->neighborhood_id)) {
            return false;
        }

        // Verificar si el operario trabaja en la misma subzona (opcional)
        if ($property->subzone_id && !$this->subzones->contains('subzone_id', $property->subzone_id)) {
            return false;
        }

        return true;
    }

}
