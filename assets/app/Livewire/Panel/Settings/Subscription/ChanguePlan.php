<?php

namespace App\Livewire\Panel\Settings\Subscription;

use App\Enums\SubscriptionStatus;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use Carbon\Carbon;

class ChanguePlan extends Component
{
    public $plans;
    public $mysubscription;
    public $subscription;
    public $selectedPlan;

    public function mount()
    {
        $this->authorize('access-function','suscription-change-plan');
        $user = auth()->user();
        $business = $user->business;
        $this->mysubscription = $business->subscription;
        $this->plans = Plan::all();
    }

    public function selectPlan(Plan $selected)
    {
        $this->selectedPlan = $selected;
        $user = Auth::user();

        if ($this->mysubscription === null) {
            // No subscription, create new
            $this->createNewSubscription($user, $this->selectedPlan);
        } else {
            // Existing subscription
            $this->handleExistingSubscription($user, $this->mysubscription, $this->selectedPlan);
        }
    }

    private function createNewSubscription($user, $selectedPlan)
    {
        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $items = $this->createItemsArray($selectedPlan);
        $payer = $this->createPayerArray($user);

        $this->mysubscription = $user->business->subscriptions()->create([
            'plan_id' => $selectedPlan->id,
            'business_id' => $user->business->id,
            'status' => SubscriptionStatus::Pending,
            'payment_method' => 'mercadopago',
        ]);

        $this->mysubscription->payments()->create([
            'payment_method' => 'mercadopago',
            'amount' => $selectedPlan->price,
            'currency' => 'ARS',
        ]);

        $this->createAndRedirectToPreference($items, $payer);
    }

    private function handleExistingSubscription($user, $currentSubscription, $selectedPlan)
    {

        if ($currentSubscription->status == SubscriptionStatus::Active) {

            if ($currentSubscription->plan->id == $selectedPlan->id) {
                session()->flash('subscription', 'Ya tienes este plan activo.');
                $this->redirectRoute('panel.settings.my-subscription.index');
            } else if ($selectedPlan->price > $currentSubscription->plan->price) {
                $this->chargeDifferenceForPlanChange($user, $currentSubscription, $selectedPlan);
            } else {
                session()->flash('subscription', 'Una vez que finalice el plan actual, puede cambiar al plan seleccionado.');
                $this->redirectRoute('panel.settings.my-subscription.index');
            }
        } else {
            // Check if there is a pending payment for the current subscription
            $pendingPayment = $currentSubscription->payments()->whereNot('status', 1)->where('is_partial', true)->first();

            if ($pendingPayment) {

                // If there is a pending partial payment, update the subscription
                $this->chargeDifferenceForPlanChange($user, $currentSubscription, $selectedPlan);
            } else {
                // Update the pending subscription
                $this->updatePendingSubscription($user, $currentSubscription, $selectedPlan);
            }
        }
    }

    private function updatePendingSubscription($user, $currentSubscription, $selectedPlan)
    {


        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $items = $this->createItemsArray($selectedPlan);
        $payer = $this->createPayerArray($user);

        // Verificar si hay solo un pago y está pendiente
        $payments = $currentSubscription->payments();

        $pendingPayment = $payments->whereNot('status', 1)->first();

        if ($user->business->subscription->whereNot('status', 4)->first()->plan->id != $selectedPlan->id) {


            if ($payments->count() < 1 && $pendingPayment) {


                // Eliminar el pago pendiente existente
                $pendingPayment->delete();

                // Actualizar el plan_id de la suscripción pendiente
                $currentSubscription->update([
                    'plan_id' => $selectedPlan->id,
                ]);

                // Crear un nuevo pago pendiente con el monto del nuevo plan
                $newPayment = $this->createNewPayment($currentSubscription, $selectedPlan);

                // Crear y redirigir a la nueva preferencia
                $this->createAndRedirectToPreference($items, $payer);

                return;
            }



            if ($currentSubscription->payments->count() == 1) {
                $currentSubscription->paymentPending->delete();
                $currentSubscription->delete();
            } else {
                $currentSubscription->paymentPending->delete();
            }

            // Si no cumple la condición anterior, crear una nueva suscripción y un nuevo pago
            $newSubscription = $user->business->subscriptions()->create([
                'plan_id' => $selectedPlan->id,
                'business_id' => $user->business->id,
                'status' => SubscriptionStatus::Pending,
                'payment_method' => 'mercadopago',
            ]);

            $this->mysubscription = $newSubscription;
        } else {
            // Eliminar el pago pendiente existente y la suscripción pendiente, asi volvemos al plan original
            $currentSubscription->paymentPending->delete();
            $currentSubscription->delete();

            $this->mysubscription = $user->business->subscription->whereIn('status', [0, 1, 3])->first();

            $newSubscription = $user->business->subscription->whereIn('status', [0, 1, 3])->first();
        }



        // Crear un nuevo pago pendiente con el monto del nuevo plan
        $newPayment = $this->createNewPayment($newSubscription, $selectedPlan);

        // Crear y redirigir a la nueva preferencia
        $this->createAndRedirectToPreference($items, $payer);
    }



    private function chargeDifferenceForPlanChange($user, $currentSubscription, $selectedPlan)
    {
        // Obtener la suscripción activa original
        $originalSubscription = $user->business->subscriptions()
            ->where('status', SubscriptionStatus::Active)
            ->orderBy('created_at', 'desc')
            ->first();
        // dd($amountToCharge, $daysRemaining, $dailyRate, $originalSubscription->plan->price, $selectedPlan->price);

        // Verificar si el plan seleccionado es el mismo que el plan original activo
        if ($selectedPlan->id == $originalSubscription->plan->id) {
            // Eliminar la suscripción pendiente y el pago parcial
            $currentPayment = $currentSubscription->payments()->where('is_partial', true)->whereNot('status', 1)->first();
            if ($currentPayment) {
                $currentPayment->delete();
            }
            $currentSubscription->delete();

            session()->flash('subscription', 'Has vuelto al plan original.');
            $this->redirectRoute('panel.settings.my-subscription.index');
            return;
        }

        // Verificar si el plan seleccionado es de menor precio que el plan original activo
        if ($selectedPlan->price < $originalSubscription->plan->price) {
            session()->flash('subscription', 'Debes esperar a que finalice tu suscripción actual para cambiar a un plan de menor nivel.');
            $this->redirectRoute('panel.settings.my-subscription.index');
            return;
        }

        $endsAt = $currentSubscription->asDate($currentSubscription->ends_at);
        $daysRemaining = Carbon::now()->diffInDays($endsAt);

        // Calcular la diferencia basada en el plan activo original
        $dailyRate = ($selectedPlan->price - $originalSubscription->plan->price) / 30; // Assuming 30 days in a month for simplicity
        $amountToCharge = $dailyRate * $daysRemaining;

        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $items = [
            [
                "id" => $selectedPlan->id,
                "title" => $selectedPlan->name,
                "description" => "Diferencia de plan " . $originalSubscription->plan->name . " a " . $selectedPlan->name,
                "currency_id" => "ARS",
                "quantity" => 1,
                "unit_price" => $amountToCharge
            ]
        ];

        $payer = $this->createPayerArray($user);

        // Verificar si hay un pago parcial pendiente
        $currentPayment = $currentSubscription->payments()->where('is_partial', true)->whereNot('status', 1)->first();

        if ($currentPayment) {
            // Eliminar el pago parcial pendiente existente
            $currentPayment->delete();

            // Actualizar el plan_id de la suscripción pendiente
            $currentSubscription->update([
                'plan_id' => $selectedPlan->id,
            ]);

            // Crear un nuevo pago pendiente con el monto actualizado
            $newPayment = $this->createNewPayment($currentSubscription, $selectedPlan, $amountToCharge, true);

            // Crear y redirigir a la nueva preferencia
            $this->createAndRedirectToPreference($items, $payer);
        } else {
            // Si no hay un pago parcial pendiente, crear una nueva suscripción
            $newSubscription = $user->business->subscriptions()->create([
                'plan_id' => $selectedPlan->id,
                'business_id' => $user->business->id,
                'status' => SubscriptionStatus::Pending,
                'starts_at' => $originalSubscription->starts_at,
                'trial_ends_at' => $originalSubscription->trial_ends_at,
                'ends_at' => $originalSubscription->ends_at,
                'payment_method' => 'mercadopago',
            ]);


            $this->mysubscription = $newSubscription;
            // Crear un nuevo pago pendiente con el monto actualizado
            $newPayment = $this->createNewPayment($newSubscription, $selectedPlan, $amountToCharge, true);

            // Crear y redirigir a la nueva preferencia
            $this->createAndRedirectToPreference($items, $payer);
        }
    }





    private function createItemsArray($selectedPlan)
    {
        return [
            [
                "id" => $selectedPlan->id,
                "title" => $selectedPlan->name,
                "description" => $selectedPlan->description,
                "currency_id" => "ARS",
                "quantity" => 1,
                "unit_price" => $selectedPlan->price
            ]
        ];
    }

    private function createPayerArray($user)
    {
        return [
            "name" => $user->name,
            "email" => $user->email,
        ];
    }

    private function createNewPayment($subscription, $selectedPlan, $amount = null, $partial = null)
    {
        $create = $subscription->payments()->create([
            'payment_method' => 'mercadopago',
            'amount' => $amount ?? $selectedPlan->price,
            'currency' => 'ARS',
        ]);

        if ($partial) {
            $create->update([
                'is_partial' => true,
            ]);
        }

        return $create;
    }

    private function createAndRedirectToPreference($items, $payer)
    {
        $request = $this->createPreferenceRequest($items, $payer);
        $client = new PreferenceClient();

        try {
            $preference = $client->create($request);

            $this->mysubscription->paymentPending()->update([
                'preference_id' => $preference->id,
                'link' => $preference->init_point,
            ]);

            $this->redirect($preference->init_point);
        } catch (MPApiException $error) {
            dd($error);
        }
    }

    private function createPreferenceRequest($items, $payer): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = [
            'success' => route('panel.settings.my-subscription.index'),
            'failure' => route('panel.settings.my-subscription.index'),
        ];

        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => $this->mysubscription->payments()->latest()->first()->id,
            "expires" => false,
            "auto_return" => 'approved',
        ];
    }

    public function render()
    {
        return view('livewire.panel.settings.subscription.changue-plan')
            ->layout('layouts.panel');
    }
}
