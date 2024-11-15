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
        $this->authorize('access-function', 'suscription-change-plan');
        $user = auth()->user();
        $business = $user->business;
        $this->mysubscription = $business->subscription;
        $this->plans = Plan::all();
    }

    public function selectPlan(Plan $selected)
    {
        $this->selectedPlan = $selected;
        $user = Auth::user();
        $business = $user->business;
        $currentSubscription = $business->subscription; // Suscripción actual



        // Verificar si el usuario ya tiene una suscripción existente
        if ($currentSubscription === null) {
            // Sin suscripción, permitir seleccionar cualquier plan
            $this->createNewSubscription($user, $selected);
        } else {

            // Manejar la lógica según el estado de la suscripción actual
            $this->handleExistingSubscription($user, $currentSubscription, $selected);
        }
    }

    private function createNewSubscription($user, $selectedPlan)
    {
        // Verificar si el usuario tiene una suscripción anterior con un pago pendiente
        $existingPendingSubscription = $user->business->subscriptions()
            ->where('status', SubscriptionStatus::Pending)
            ->whereHas('payments', function ($query) {
                $query->where('status', '!=', 1); // Pago pendiente
            })
            ->first();



        if ($existingPendingSubscription) {
            // Eliminar la suscripción y el pago pendiente anterior
            $existingPendingSubscription->payments()->delete();
            $existingPendingSubscription->delete();
        }




        if ($user->business->paymentsPendings->count() > 0) {

            foreach ($user->business->paymentsPendings as $payment) {
                $payment->delete();
            }
        }


        //verificar si hay pagos pendientes


        // Crear nueva suscripción y pago pendiente
        $this->initializePaymentProcess($user, $selectedPlan);
    }

    private function initializePaymentProcess($user, $selectedPlan)
    {
        // Configurar MercadoPago
        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $items = $this->createItemsArray($selectedPlan);
        $payer = $this->createPayerArray($user);

        // Crear nueva suscripción
        $this->mysubscription = $user->business->subscriptions()->create([
            'plan_id' => $selectedPlan->id,
            'business_id' => $user->business->id,
            'status' => SubscriptionStatus::Pending,
            'payment_method' => 'mercadopago',
        ]);

        // Crear nuevo pago pendiente
        $this->mysubscription->payments()->create([
            'payment_method' => 'mercadopago',
            'amount' => $selectedPlan->price,
            'currency' => 'ARS',
        ]);

        // Crear preferencia y redirigir
        $this->createAndRedirectToPreference($items, $payer);
    }

    private function handleExistingSubscription($user, $currentSubscription, $selectedPlan)
    {
        $business = $user->business;

        // Obtener la suscripción activa original
        $originalSubscription = $business->subscriptionActive;


        // Si no hay una suscripción activa, permitir al usuario seleccionar cualquier plan
        if ($originalSubscription === null) {
            $this->createNewSubscription($user, $selectedPlan);
            return;
        }


        // Verificar si hay una suscripción pendiente (por ejemplo, por un cambio de plan anterior)
        $pendingSubscription = $business->subscriptions()
            ->where('status', SubscriptionStatus::Pending)
            ->where('id', '!=', $originalSubscription->id)
            ->first();



        switch ($originalSubscription->status) {
            case SubscriptionStatus::Active:
                $this->handleActiveSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription, $pendingSubscription);
                break;

            case SubscriptionStatus::GracePeriod:
            case SubscriptionStatus::Expired:
                // El comportamiento en "Periodo de Gracia" y "Expirada" es el mismo
                $this->handleGraceOrExpiredSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription, $pendingSubscription);
                break;

            case SubscriptionStatus::Pending:
                // **Nuevo manejo para suscripción en estado Pendiente**
                $this->handlePendingSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription);
                break;

            case SubscriptionStatus::Cancelled:
                // No se permite cambiar de plan
                session()->flash('subscription', 'Tu suscripción ha sido cancelada, no puedes cambiar de plan.');
                $this->redirectRoute('panel.settings.my-subscription.index');
                break;

            default:
                // Otros estados
                session()->flash('subscription', 'No puedes cambiar de plan en este momento.');
                $this->redirectRoute('panel.settings.my-subscription.index');
                break;
        }
    }

    private function handleActiveSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription, $pendingSubscription)
    {


        if ($selectedPlan->id == $originalSubscription->plan->id) {
            // El usuario quiere volver al plan original


            if ($pendingSubscription) {
                // Eliminar la suscripción pendiente y su pago
                $pendingSubscription->payments()->delete();
                $pendingSubscription->delete();

                dump('Eliminando suscripción pendiente');
            }

            // Asegurarse de que no haya pagos pendientes en la suscripción original
            $pendingPayment = $originalSubscription->payments()->where('status', '!=', 1)->first();
            if ($pendingPayment) {
                $pendingPayment->delete();
            }

            session()->flash('subscription', 'Ya tienes este plan activo.');
            $this->redirectRoute('panel.settings.my-subscription.index');
        } elseif ($selectedPlan->price > $originalSubscription->plan->price) {

            // El usuario quiere subir a un plan superior
            $this->upgradeSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription);
        } else {
            // El usuario quiere bajar a un plan inferior
            session()->flash('subscription', 'No puedes cambiar a un plan inferior hasta que finalice tu suscripción actual.');
            $this->redirectRoute('panel.settings.my-subscription.index');
        }
    }

    private function handleGraceOrExpiredSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription, $pendingSubscription)
    {

        // Eliminar el pago pendiente de la suscripción original
        $pendingPayment = $originalSubscription->payments()->where('status', '!=', 1)->first();

        if ($pendingPayment) {
            $pendingPayment->delete();
        }

        if ($pendingSubscription) {
            // Eliminar la suscripción pendiente y su pago
            $pendingSubscription->payments()->delete();
            $pendingSubscription->delete();
        }

        if ($selectedPlan->id == $originalSubscription->plan->id) {
            // El usuario quiere renovar el mismo plan

            // Crear nuevo pago pendiente para la suscripción original
            $this->initializePaymentProcessForExistingSubscription($user, $originalSubscription);
        } else {
            // El usuario quiere cambiar a un plan diferente (más alto o más bajo)

            // Crear una nueva suscripción y pago pendiente
            $this->initializePaymentProcess($user, $selectedPlan);
        }
    }

    private function handlePendingSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription)
    {
        // Eliminar la suscripción pendiente actual y sus pagos
        $currentSubscription->payments()->delete();
        $currentSubscription->delete();

        if ($selectedPlan->id == $originalSubscription->plan->id) {
            // El usuario quiere volver al plan original

            // Asegurarse de que no haya pagos pendientes en la suscripción original
            $pendingPayment = $originalSubscription->payments()->where('status', '!=', 1)->first();
            if ($pendingPayment) {
                $pendingPayment->delete();
            }

            // Crear nuevo pago pendiente para la suscripción original
            $this->initializePaymentProcessForExistingSubscription($user, $originalSubscription);
        } else {
            // El usuario quiere cambiar a un plan diferente

            // Crear una nueva suscripción y pago pendiente
            $this->initializePaymentProcess($user, $selectedPlan);
        }
    }

    private function initializePaymentProcessForExistingSubscription($user, $subscription)
    {
        // Configurar MercadoPago
        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $selectedPlan = $subscription->plan;
        $items = $this->createItemsArray($selectedPlan);
        $payer = $this->createPayerArray($user);

        // Crear nuevo pago pendiente para la suscripción existente
        $subscription->payments()->create([
            'payment_method' => 'mercadopago',
            'amount' => $selectedPlan->price,
            'currency' => 'ARS',
        ]);

        $this->mysubscription = $subscription;

        // Crear preferencia y redirigir
        $this->createAndRedirectToPreference($items, $payer);
    }

    private function upgradeSubscription($user, $currentSubscription, $selectedPlan, $originalSubscription)
    {
        // Verificar si ya existe una suscripción pendiente para este upgrade
        $pendingSubscription = $user->business->subscriptions()
            ->where('status', SubscriptionStatus::Pending)
            ->where('plan_id', $selectedPlan->id)
            ->first();

        if ($pendingSubscription) {
            // Eliminar la suscripción pendiente y sus pagos
            $pendingSubscription->payments()->delete();
            $pendingSubscription->delete();
        }

        // Calcular días restantes de la suscripción original
        $endsAt = Carbon::parse($originalSubscription->ends_at);
        $daysRemaining = Carbon::now()->diffInDays($endsAt);

        // Calcular la diferencia de precio entre el plan seleccionado y el plan original
        $priceDifference = $selectedPlan->price - $originalSubscription->plan->price;

        // Calcular el monto a cobrar
        $dailyRate = $priceDifference / 30; // Suponiendo 30 días al mes
        $amountToCharge = $dailyRate * $daysRemaining;

        // Crear nueva suscripción y pago parcial
        $this->initializePartialSubscription($user, $selectedPlan, $amountToCharge, $originalSubscription);
    }

    private function initializePartialSubscription($user, $selectedPlan, $amountToCharge, $originalSubscription)
    {
        // Configurar MercadoPago
        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $items = [
            [
                "id" => $selectedPlan->id,
                "title" => $selectedPlan->name,
                "description" => "Diferencia de plan",
                "currency_id" => "ARS",
                "quantity" => 1,
                "unit_price" => $amountToCharge
            ]
        ];
        $payer = $this->createPayerArray($user);

        // Crear nueva suscripción para el plan superior
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

        // Crear nuevo pago parcial
        $payment = $newSubscription->payments()->create([
            'payment_method' => 'mercadopago',
            'amount' => $amountToCharge,
            'currency' => 'ARS',
            'is_partial' => true,
        ]);

        // Crear preferencia y redirigir
        $this->createAndRedirectToPreference($items, $payer);
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

    private function createAndRedirectToPreference($items, $payer)
    {
        $request = $this->createPreferenceRequest($items, $payer);
        $client = new PreferenceClient();

        try {
            $preference = $client->create($request);

            $this->mysubscription->payments()->latest()->first()->update([
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
