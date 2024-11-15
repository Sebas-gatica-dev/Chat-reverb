<?php

namespace App\Models;

use App\Enums\FrequencyEnum;
use App\Observers\PropertyObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([PropertyObserver::class])]
class Property extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded = [];

    protected $casts = ['frequency' => FrequencyEnum::class];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable')->orderBy('order', 'asc');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function propertyType()
    {

        return $this->belongsTo(PropertyType::class, 'property_type');
    }


    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }


    public function budget(){

        return $this->hasOne(Budget::class)->orderBy('created_at', 'desc');
    }




    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    protected function documentation(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->formatCuitOrDni($value),
            set: fn($value) => str_replace(['.', '-'], '', $value),
        );
    }

    /**
     * Format the CUIT or DNI value.
     */
    private function formatCuitOrDni($value)
    {
        if (strlen($value) === 11) {
            // Formatear CUIT: XX-XXXXXXXX-X
            return substr($value, 0, 2) . '-' . substr($value, 2, 8) . '-' . substr($value, 10, 1);
        } elseif (strlen($value) === 7 || strlen($value) === 8) {
            // Formatear DNI: X.XXX.XXX o XX.XXX.XXX
            return number_format($value, 0, '', '.');
        }

        return $value; // Retornar el valor sin formato si no cumple con las condiciones
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function subzone()
    {
        return $this->belongsTo(Subzone::class);
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getPhotoUrl($value),
        );
    }

    private function getPhotoUrl($value)
    {
        if (!$value || filter_var($value, FILTER_VALIDATE_URL)) {
            return 'https://placehold.co/400';
        }

        // Si el valor no es un enlace, se asume que es un path
        return asset('storage/' . $value);
    }

    public function getFrequencyText(): string
    {
        return FrequencyEnum::getFrequency($this->frequency);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class)->orderBy('date', 'desc')->orderBy('time', 'desc');
    }

    public function visitInspect()
    {
        return $this->hasOne(Visit::class)->where('inspect_visit', true);
    }



    public function availabilities()
    {
        return $this->morphMany(Availability::class, 'availabilitable');
    }

    public function specialAvailabilities()
    {
        return $this->morphMany(SpecialAvailability::class, 'available');
    }
}
