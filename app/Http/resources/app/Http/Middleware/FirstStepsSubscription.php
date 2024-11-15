<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstStepsSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $user = auth()->user();
        $business = $user->business;

        if (!$business) {
            // Dejar pasar la solicitud si el usuario no tiene un negocio
            return $next($request);
        }

        $subscripcion = $business->subscription()->doesntExist();

        if ($subscripcion) {
            // Redirigir si no existe ninguna suscripción
            return $next($request);
        }

        $paymentOnlyOne = Payment::whereIn('subscription_id', $business->subscriptions->pluck('id'))->where('status', 1)->count();
        $subscripcionDontActive = $business->subscription->status == 0;

        if ($paymentOnlyOne == 0 && $subscripcionDontActive) {
            return $next($request);
        }

        return redirect()->route('panel.settings.my-subscription.index');
    }
}
