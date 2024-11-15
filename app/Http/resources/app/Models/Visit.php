<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\StatusVisitEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Visit extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['date'];

    protected $casts = [
        'visit_activity' => 'json',
        'status' => StatusVisitEnum::class,
        'expected_payment' => PaymentMethodEnum::class,
    ];



    
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }



    public function cratedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function avaliabilities()
    {
        return $this->morphMany(Availability::class, 'availabilitable');
    }

    public function getStatus(): string
    {
        return StatusVisitEnum::getStatus($this->status);
    }

    public function statusChanges()
    {
        return $this->hasMany(StatusChange::class);
    }

    public function payments()
    {
        return $this->hasMany(PaymentVisit::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_visit');
    }



    public function getVisitActivity()
    {
        return json_decode($this->visit_activity, true);
    }



    public function users()
    {
        return $this->belongsToMany(User::class, 'user_visit', 'visit_id', 'user_id');
    }

    public function commissions()
    {
        return $this->morphMany(Commission::class, 'commissionable');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }



    public function visitType()
    {
        return $this->belongsTo(VisitType::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function availabilities()
    {
        return $this->morphMany(Availability::class, 'availabilitable');
    }

    public function specialAvailabilities()
    {
        return $this->morphMany(SpecialAvailability::class, 'available');
    }


    public function paginatedComments($perPage = 4, $principalComment = null)
    {
        return $this->comments()
            ->when($principalComment, function ($query) use ($principalComment) {
                return $query->where('id', '!=', $principalComment->id);
            })
            ->with('user', 'files')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (floor($attributes['price']) == $attributes['price']
                ? number_format($attributes['price'], 0, ',', '.')
                : number_format($attributes['price'], 2, ',', '.')),
            set: fn ($value) => [
                'price' => str_replace(['$', '.', ','], ['', '', '.'], $value),
            ]
        );
    }

    protected function priceIva(): Attribute
    {
        return Attribute::make(
            get: fn ($value,$attributes) => (floor($attributes['price'] * 1.21) == $attributes['price'] *1.21
                ? number_format($attributes['price'] * 1.21, 0, ',', '.')
                : number_format($attributes['price'] * 1.21, 2, ',', '.')),
        );
    }




    protected function amountReceived(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (floor($attributes['amount_received']) == $attributes['amount_received']
                ? number_format($attributes['amount_received'], 0, ',', '.')
                : number_format($attributes['amount_received'], 2, ',', '.')),
            set: fn ($value) => [
                'amount_received' => str_replace(['$', '.', ','], ['', '', '.'], $value),
            ]
        );
    }



    public function requestPayment()
    {
        return $this->morphOne(RequestPayment::class, 'referenceable');
    }

}
