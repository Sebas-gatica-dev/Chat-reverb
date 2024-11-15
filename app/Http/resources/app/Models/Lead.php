<?php

namespace App\Models;

use App\Enums\SourceEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeContactEnum;
use App\Jobs\GenerateBudgetPdf;
use App\Observers\LeadObserver;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([LeadObserver::class])]
class Lead extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status' => StatusCustomerEnum::class,
        'type_contact' => TypeContactEnum::class,
        'source' => SourceEnum::class
    ];



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


    // In app/Models/Lead.php

    public function budget()
    {
        return $this->morphOne(Budget::class, 'budgetable');
    }


    public function activities()
    {
        return $this->hasMany(LeadActivity::class)->orderBy('date', 'desc')->orderBy('time');
    }


}
