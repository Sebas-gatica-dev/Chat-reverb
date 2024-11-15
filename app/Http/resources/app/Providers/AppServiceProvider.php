<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //$this->registerPolicies();

        Gate::define('access-function', function (User $user, $featureName = null) {


           //Si el usuario tiene negocio y tiene subscripcion entonces se le permite el acceso a la funcion solicitada

            if ($user->business && $user->business->subscription) {
                $business = $user->business;

                $combinedFeatures = $business->getCombinedFunctions();

               

                if ($featureName === null)
                    return true;
                else
                    return in_array($featureName, array_column($combinedFeatures, 'slug'));
            }else{
              
                return true;
            }


        });




        Carbon::setLocale(config('app.locale'));
    }
}
