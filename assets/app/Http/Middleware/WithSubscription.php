<?php

namespace App\Http\Middleware;

use App\Enums\SubscriptionStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WithSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        $business = $user->business;
        $subscription = $business->subscription;

        if (!$subscription) {
            session()->flash('subscription', 'Todavía no elegiste un plan, regístrate por primera vez');
            return redirect()->route('panel.first-steps.plan');
        }

        switch ($subscription->status) {
            case SubscriptionStatus::Active:
                return $next($request);
            case SubscriptionStatus::Expired:
                session()->flash('subscription', 'Tu suscripción ha expirado, por favor renueva.');
            return redirect()->route('panel.settings.my-subscription.index');
            case SubscriptionStatus::Pending:
                session()->flash('subscription', 'Tu suscripción está pendiente de pago, por favor realiza el pago.');
                return redirect()->route('panel.settings.my-subscription.index');
            case SubscriptionStatus::GracePeriod:
                session()->flash('subscription', 'Tu suscripción está en periodo de gracia, por favor renueva para que no se cancele.');
                return $next($request);
            case SubscriptionStatus::Cancelled:
                session()->flash('subscription', 'Tu suscripción ha sido cancelada, por favor renueva.');
                return redirect()->route('panel.settings.my-subscription.index');
            default:
                return abort(403);
        }
    }
}
