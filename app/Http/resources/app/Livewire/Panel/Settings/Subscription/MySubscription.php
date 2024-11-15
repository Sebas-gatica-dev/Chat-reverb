<?php

namespace App\Livewire\Panel\Settings\Subscription;

use App\Enums\SubscriptionStatus;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MySubscription extends Component
{

    public $subscription;
    public $payments;

    public function mount()
    {
        $this->authorize('access-function', 'my-suscription');

        $this->subscription = auth()->user()->business->subscription;
        $this->payments = auth()->user()->business->payments;



        if (!$this->subscription) {
            return redirect()->route('panel.settings.my-subscription.changue-plan');
        }
    }


    // public function payPayment($paymentId)
    // {
    //     $payment = Payment::find($paymentId);

    //     if ($payment) {
    //         // Actualizamos el pago pendiente como pagado
    //         $payment->update([
    //             'status' => 1,
    //             'paid_at' => Carbon::now(),
    //             'response' => '',
    //         ]);

    //         // Obtenemos la suscripción asociada al pago
    //         $subscription = $payment->subscription;

    //         if ($subscription) {
    //             $business = $subscription->business;

    //             // Verificamos si es un pago parcial (upgrade de plan)
    //             if ($payment->is_partial) {
    //                 // Al crear una nueva suscripción más alta, la anterior pasa a estado cancelada

    //                 // Actualizamos la nueva suscripción como activa
    //                 $subscription->update([
    //                     'status' => SubscriptionStatus::Active->value,
    //                     'starts_at' => Carbon::now(),
    //                 ]);

    //                 // Obtenemos la suscripción anterior (que no sea la actual)
    //                 $previousSubscription = $business->subscriptions()
    //                     ->where('id', '!=', $subscription->id)
    //                     ->whereIn('status', [SubscriptionStatus::Active->value, SubscriptionStatus::GracePeriod->value, SubscriptionStatus::Expired->value])
    //                     ->latest('created_at')
    //                     ->first();

    //                 if ($previousSubscription) {
    //                     // Marcamos la suscripción anterior como cancelada
    //                     $previousSubscription->update([
    //                         'status' => SubscriptionStatus::Cancelled->value,
    //                     ]);

    //                     // Eliminamos cualquier pago pendiente de la suscripción anterior
    //                     $pendingPayment = $previousSubscription->payments()->where('status', '!=', 1)->first();
    //                     if ($pendingPayment) {
    //                         $pendingPayment->delete();
    //                     }
    //                 }
    //             } else {
    //                 // Si la suscripción es Pendiente o Expirada
    //                 if ($subscription->status == SubscriptionStatus::Pending || $subscription->status == SubscriptionStatus::Expired) {
    //                     // Calculamos la fecha de finalización de la suscripción
    //                     $endDate = $this->calculateEndDate($subscription->plan);


    //                     // Si la suscripción no tiene fecha de inicio, es una nueva suscripción
    //                     if (!$subscription->starts_at) {
    //                         $subscription->update([
    //                             'starts_at' => Carbon::now(),
    //                             'status' => SubscriptionStatus::Active->value,
    //                             'ends_at' => $endDate,
    //                             'trial_ends_at' => $endDate->copy()->addDays($subscription->plan->free_trial_days),
    //                         ]);
    //                     } else {
    //                         // Es una renovación de suscripción
    //                         $subscription->update([
    //                             'status' => SubscriptionStatus::Active->value,
    //                             'ends_at' => $endDate,
    //                         ]);
    //                     }

    //                     // Obtenemos la suscripción anterior (que no sea la actual)
    //                     $previousSubscription = $business->subscriptions()
    //                         ->where('id', '!=', $subscription->id)
    //                         ->whereIn('status', [SubscriptionStatus::Active->value, SubscriptionStatus::GracePeriod->value, SubscriptionStatus::Expired->value])
    //                         ->latest('created_at')
    //                         ->first();


    //                     if ($previousSubscription) {
    //                         // Marcamos la suscripción anterior como cancelada
    //                         $previousSubscription->update([
    //                             'status' => SubscriptionStatus::Cancelled->value,
    //                         ]);
    //                     }
    //                 } else {
    //                     // Extendemos la suscripción actual
    //                     $subscription->update([
    //                         'status' => SubscriptionStatus::Active->value,
    //                         'ends_at' => $this->calculateEndDate($subscription->plan, $subscription->ends_at),
    //                         'trial_ends_at' => $this->calculateEndDate($subscription->plan, $subscription->trial_ends_at),
    //                     ]);

    //                     // No es necesario actualizar la suscripción anterior en este caso
    //                 }


    //                 $previousSubscription = $business->subscriptions()
    //                     ->where('id', '!=', $subscription->id)
    //                     ->whereIn('status', [SubscriptionStatus::Active->value, SubscriptionStatus::GracePeriod->value, SubscriptionStatus::Expired->value])
    //                     ->latest('created_at')
    //                     ->first();


    //                 if ($previousSubscription) {
    //                     // Marcamos la suscripción anterior como cancelada
    //                     $previousSubscription->update([
    //                         'status' => SubscriptionStatus::Cancelled->value,
    //                     ]);
    //                 }


    //                 // Eliminamos cualquier suscripción pendiente (que no sea la actual)
    //                 $subscriptionPending = $business->subscriptions()
    //                     ->where('status', SubscriptionStatus::Pending->value)
    //                     ->where('id', '!=', $subscription->id)
    //                     ->first();



    //                 if ($subscriptionPending) {
    //                     $pendingPayment = $subscriptionPending->payments()->where('status', '!=', 1)->first();
    //                     if ($pendingPayment) {
    //                         $pendingPayment->delete();
    //                     }
    //                     $subscriptionPending->delete();
    //                 }
    //             }



    //             flushCacheBusinessFunctions($business->id);


    //         }

    //         return response()->json(['status' => '200', 'message' => 'OK']);
    //     } else {
    //         return response()->json(['status' => '404', 'message' => 'Not found']);
    //     }
    // }



    public function render()
    {
        return view('livewire.panel.settings.subscription.my-subscription')
            ->layout('layouts.panel');
    }
}
