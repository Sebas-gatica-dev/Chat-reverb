<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MercadoPagoWebhookController extends Controller
{

    public function index(Request $request)
    {


        $type = $request->type;

        if ($type == 'payment') {
            $payment_id = $request->data['id'];
        }

        $response = Http::get(
            'https://api.mercadopago.com/v1/payments/' . $payment_id . '?access_token=' . config('tokens.mercado-pago')
        );
        $response = $response->json();

        if ($response['status'] == 'approved') {

            $payment = Payment::find($response['external_reference']);

            if ($payment) {
                $payment->update([
                    'status' => 1,
                    'paid_at' => Carbon::now()->toDateTimeString(),
                    'response' => json_encode($request->all()),
                ]);


                $subscription = $payment->subscription;

                if ($subscription) {
                    if ($payment->is_partial) {

                        $empresa = $payment->subscription->business;

                        $previusSubscription = $empresa->subscriptions()->latest('created_at')->skip(1)->first();

                        $subscription->update([
                            'status' => 1,
                            // 'starts_at' => Carbon::now()->toDateTimeString(),
                        ]);

                        $previusSubscription->update([
                            'status' => 4,
                        ]);
                    } else {


                        if (in_array($subscription->status->value, [0, 2])) {
                            $endDate = $this->calculateEndDate($subscription->plan);


                            if(!$subscription->starts_at){
                                $subscription->update([
                                    'starts_at' => Carbon::now(),
                                    'status' => 1,
                                    'ends_at' => Carbon::parse($endDate),
                                    'trial_ends_at' => Carbon::parse($endDate)->addDays($subscription->plan->free_trial_days),
                                ]);
                            }else{
                                $subscription->update([
                                    'status' => 1,
                                    'ends_at' => Carbon::parse($endDate),
                                ]);

                                $previusSubscription = $subscription->business->subscriptions()->latest('created_at')->skip(1)->first();


                                if($previusSubscription){
                                    $previusSubscription->update([
                                        'status' => 4,
                                    ]);
                                }
                            }

                        } else {
                            $subscription->update([
                                'status' => 1,
                                'ends_at' => $this->calculateEndDate($subscription->plan, $subscription->ends_at),
                                'trial_ends_at' => $this->calculateEndDate($subscription->plan, $subscription->ends_at),
                            ]);
                        }
                    }
                }

                return response()->json(['status' => '200', 'message' => 'OK']);
            }else{
                return response()->json(['status' => '404', 'message' => 'Not found']);
            }
        } elseif ($response['status'] == 'rejected') {

            Payment::find($response['external_reference'])->update([
                'status' => 2,
            ]);

            return response()->json(['status' => '200', 'message' => 'OK']);
        }
    }
    private function calculateEndDate($plan, $dateSubscription = null)
    {
        if ($plan->duration_unit == 'month') {

            if ($dateSubscription) {
                return Carbon::parse($dateSubscription)->addMonths($plan->duration);
            }
            return Carbon::now()->addMonths($plan->duration);
        } elseif ($plan->duration_unit == 'year') {
            if ($dateSubscription) {
                return Carbon::parse($dateSubscription)->addYears($plan->duration);
            }
            return Carbon::now()->addYears($plan->duration);
        }
    }
}
