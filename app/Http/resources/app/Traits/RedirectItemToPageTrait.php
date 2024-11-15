<?php

namespace App\Traits;

use App\Enums\StatusCustomerEnum;
use App\Helpers\Notifications;
use App\Models\Customer;
use Carbon\Carbon;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Validation\ValidationException;


trait RedirectItemToPageTrait
{




    protected function redirectToCustomerPage($leadId, $perPage = 10)
    {
        $lead = Customer::findOrFail($leadId);

        $dateStartLead = Carbon::parse($lead->date_lead)->startOfMonth()->format('Y-m-d');
        $dateEndLead = Carbon::parse($lead->date_lead)->endOfMonth()->format('Y-m-d');

        $customers = Customer::where('business_id', auth()->user()->business_id)
            ->whereBetween('date_lead', [$dateStartLead, $dateEndLead])
            ->where('status', StatusCustomerEnum::CLOSED->value)
            ->pluck('id');

        $position = $customers->search($lead->id);

        $page = ceil(($position + 1) / $perPage);

        return redirect()->route('panel.leads.list', [
            'desde' => $dateStartLead,
            'hasta' => $dateEndLead,
            'page' => $page,
        ]);
    }

}
