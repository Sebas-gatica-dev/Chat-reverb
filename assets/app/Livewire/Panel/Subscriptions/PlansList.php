<?php

namespace App\Livewire\Panel\Subscriptions;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class PlansList extends Component
{

    public $plans;
    public $selectedPlan;
    public $subscription;

    public function mount()
    {

        $this->subscription = Auth::user()->business->subscription;
        $this->plans = Plan::all();


    }
    public function render()
    {
        return view('livewire.panel.subscriptions.plans-list')
            ->layout('layouts.panel');
    }




    public function selectPlan(Plan $selectedPlan)
    {




        MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);


        $auth = Auth::user();

        // Mount the array of products that will integrate the purchase amount
        $items = array(array(
            "id" => $selectedPlan->id,
            "title" => $selectedPlan->name,
            "description" => $selectedPlan->description,
            "currency_id" => "ARS",
            "quantity" => 1,
            "unit_price" => $selectedPlan->price
        ));


        $payer = array(
            "name" => $auth->name, // Replace with the user's name
            "email" => $auth->email, // Replace with the user's email
        );





        $this->subscription = $auth->business->subscriptions()->create([
            'plan_id' => $selectedPlan->id,
            'business_id' => $auth->business->id,
            'status' => 2,
            'payment_method' => 'mercadopago',
        ]);

        $this->subscription->payments()->create([
            'payment_method' => 'mercadopago',
            'amount' => $selectedPlan->price,
            'currency' => 'ARS',
        ]);

        $request = $this->createPreferenceRequest($items, $payer);
        $client = new PreferenceClient();

        try {
            // Send the request that will create the new preference for user's checkout flow
            $preference = $client->create($request);

            $this->subscription->paymentPending()->update([
                'preference_id' => $preference->id,
                'link' => $preference->init_point,
            ]);
            // Useful props you could use from this object is 'init_point' (URL to Checkout Pro) or the 'id'
            $this->redirect($preference->init_point);
        } catch (MPApiException $error) {
            // Handle the error
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

        $backUrls = array(
            'success' => route('panel.payment-status.success'),
            'failure' => route('panel.payment-status.rejected'),
        );

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => $this->subscription->paymentPending->id,
            "expires" => false,
            "auto_return" => 'approved',
        ];

        return $request;
    }


}
