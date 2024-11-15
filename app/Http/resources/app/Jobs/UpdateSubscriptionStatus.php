<?php

namespace App\Jobs;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class UpdateSubscriptionStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    //while true; do php artisan update:subscription-status; sleep 2; done

    /**
     * Execute the job.
     */
    public function handle(): void
    {


        $today = Carbon::now()->startOfDay();

        // Obtener suscripciones que no están expiradas
        $subscriptions = Subscription::whereIn('status', [SubscriptionStatus::Active->value, SubscriptionStatus::GracePeriod->value])
            ->get();


        foreach ($subscriptions as $subscription) {


            $paymentsPending = $subscription->business->paymentsPendings()->whereHas('subscription', function ($query) use ($subscription) {
                $query->where('id', '!=', $subscription->id);
            })->get();

            foreach ($paymentsPending as $payment) {
                $payment->delete();
                $payment->subscription->delete();
            }



            if ($subscription->ends_at) {
                $endsAt = Carbon::parse($subscription->ends_at)->startOfDay();

                if ($endsAt->lt($today)) {
                    $diffInDays = $endsAt->diffInDays($today);





                    if ($diffInDays > 3) {
                        $subscription->status = SubscriptionStatus::Expired->value; // Expirado

                        flushCacheBusinessFunctions($subscription->business->id);

                    } else {
                        $subscription->status = SubscriptionStatus::GracePeriod->value; // Período de gracia


                        if ($subscription->business->payments()->where('payments.status', 0)->doesntExist()) {


                            MercadoPagoConfig::setAccessToken(config('tokens.mercado-pago'));
                            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

                            $items = [
                                [
                                    "id" => $subscription->plan->id,
                                    "title" => $subscription->plan->name,
                                    "description" => $subscription->plan->description,
                                    "currency_id" => "ARS",
                                    "quantity" => 1,
                                    "unit_price" => $subscription->plan->price,
                                ]
                            ];


                            $payer = [
                                "name" => $subscription->business->createdBy->name,



                                "email" => $subscription->business->createdBy->email,
                            ];

                            $payment = $subscription->payments()->create([
                                'amount' => $subscription->plan->price,

                                'currency' => 'ARS',
                                'payment_method' => 'mercadopago',
                                'status' => 0,
                            ]);

                            $request = $this->createPreferenceRequest($items, $payer, $payment);

                            $client = new PreferenceClient();

                            try {
                                $preference = $client->create($request);

                                $payment->update([
                                    'preference_id' => $preference->id,
                                    'link' => $preference->init_point,
                                ]);
                            } catch (MPApiException $error) {
                                dd($error);
                            }
                        }
                    }

                    $subscription->save();
                }
            }
        }
    }



    private function createPreferenceRequest($items, $payer, $payment): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = [
            'success' => route('panel.payment-status.success'),
            'failure' => route('panel.payment-status.rejected'),
        ];

        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => $payment->id,
            "expires" => false,
            "auto_return" => 'approved',
        ];
    }
}
