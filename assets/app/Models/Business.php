<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class Business extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];




    //ACCESORES
    // protected function logo(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (?string $value) => $value ? Storage::disk('public')->url($value) : 'https://fundaciongaem.org/wp-content/uploads/2016/05/no-foto.jpg',
    //     );
    // }


    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getLogoUrl($value),
        );
    }
    private function getLogoUrl($value)
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



    public function customers ()
    {
        return $this->hasMany(Customer::class);
    }




    //RELACIONES
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }


    public function plan()
    {
        return $this->hasOneThrough(Plan::class, Subscription::class, 'business_id', 'id', 'id', 'plan_id');
    }


    public function hasSubscription()
    {
        return $this->subscriptions()->where('status', 1)->exists();
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latest('created_at');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }


    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Subscription::class)->latest('created_at');
    }


    public function features(): MorphToMany
    {
        return $this->morphToMany(Feature::class, 'featureable');
    }




    public function propertiesTypes()
    {
        return $this->hasMany(PropertyType::class);
    }

    public function visitsTypes()
    {
        return $this->hasMany(VisitType::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
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

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function getCombinedFunctions()
    {

        return Cache::remember('business-functions-' . $this->id, now()->addHours(1), function () {





            $industryId = $this->industry->id;
            // Obtener funciones del plan
            $planFunctions = $this->plan->features()->select(['id', 'slug', 'count'])->get();

            // Obtener funciones de la industria
            $industryFunctions = $this->plan->featuresIndustry($industryId)->select(['id', 'slug', 'count'])->get();

            // Obtener funciones específicas del negocio
            $businessFunctions = $this->features()->select(['id', 'slug', 'count'])->get();





           $role = Feature::whereHas('roles', function ($query) {
                $query->whereIn('id', auth()->user()->roles->pluck('id'));
            })->select(['id', 'slug'])->get();

            // Combinar todas las funciones
            $features = $planFunctions->merge($industryFunctions)->merge($businessFunctions)->unique('id');

           // dd($features->pluck('slug'), $role->pluck('slug'));
            $features= $features->intersect($role)->select('id', 'slug', 'count')->toArray();

            return $features;
        });
    }


    //Duplicar roles que tengan business_id null y asignarlos al negocio
    public function duplicateRoles()
    {


        // Duplicar roles genéricos y asignarlos al nuevo negocio
        $genericRoles = Role::whereNull('business_id')->get();
        foreach ($genericRoles as $genericRole) {
            $newRole = $genericRole->replicate();
            $newRole->business_id = $this->id;
            $newRole->save();

            // Duplicar las funciones asociadas a los roles genéricos y asignarlas a los nuevos roles
            foreach ($genericRole->features as $feature) {
                // $newFeature = $genericFeature->replicate();
                $newRole->features()->attach($feature->id);
            }
        }

    }

    public function users()
    {
        return $this->hasMany(User::class);
    }



    public function roles()
    {
        return $this->hasMany(Role::class, 'business_id');
    }

    public function zones()
    {
        $provincias = $this->provinces->take(3)->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'model' => 'Provincia'];
        });

        $ciudades = $this->cities->take(3)->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'model' => 'Ciudad'];
        });

        $barrios = $this->neighborhoods->take(3)->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'model' => 'Barrio'];
        });

        $subzonas = $this->subzones->take(3)->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'model' => 'Subzona'];
        });

        // Combina todas las colecciones
        $zonas = $provincias->merge($ciudades)->merge($barrios)->merge($subzonas);

        // Convierte la colección combinada a un array
        return $zonas->toArray();

    }


    public function visits(){
        return $this->hasMany(Visit::class);
    }



    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
