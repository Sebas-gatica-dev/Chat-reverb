<?php

namespace App\Enums;

use App\Models\Comment;
use App\Models\Customer;
use App\Models\Property;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

enum WidgetLogicEnum: string
{
    case USERS = 'users';
    case COMMENTS = 'comments';
    case VISITS = 'visits';
    case PROPERTIES = 'properties';
    case CUSTOMERS = 'customers';
    case LEADS = 'leads';
    case SALES = 'sales';

    public function getName(): string
    {
        return match ($this) {
            self::USERS => 'Usuarios',
            self::COMMENTS => 'Comentarios',
            self::VISITS => 'Visitas',
            self::PROPERTIES => 'Propiedades',
            self::CUSTOMERS => 'Clientes',
            self::LEADS => 'Leads',
            self::SALES => 'Ventas',
        };
    }

    public function getData($start, $end, $isMonthRange): array
    {
        $dateSelect = $isMonthRange == 'month' ? 'DATE_FORMAT(created_at, "%Y-%m") as datez' : 'DATE(created_at) as datez';

        return match ($this) {
            self::USERS => User::selectRaw("$dateSelect, COUNT(*) as total")
                ->whereBetween('created_at', [$start, $end])
                ->where('business_id', Auth::user()->business_id)
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),

            self::COMMENTS => Comment::selectRaw("$dateSelect, COUNT(*) as total")
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),

                self::VISITS => Visit::selectRaw($isMonthRange == 'month' ? 'DATE_FORMAT(date, "%Y-%m") as datez' : 'DATE(date) as datez')
                ->selectRaw('COUNT(*) as total')
                ->whereBetween('date', [$start, $end])
                ->where('status', StatusVisitEnum::COMPLETED->value)
                ->where('business_id', Auth::user()->business_id)
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),


            self::PROPERTIES => Property::selectRaw("$dateSelect, COUNT(*) as total")
                ->whereBetween('created_at', [$start, $end])
                ->where('business_id', Auth::user()->business_id)
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),

            self::CUSTOMERS =>  
            Customer::selectRaw("$dateSelect, COUNT(*) as total")
                ->whereBetween('created_at', [$start, $end])
                ->where('business_id', Auth::user()->business_id)
                ->where('status', StatusCustomerEnum::CLOSED->value)
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),

            self::LEADS => Customer::selectRaw("$dateSelect, COUNT(*) as total")
                ->whereBetween('created_at', [$start, $end])
                ->where('business_id', Auth::user()->business_id)
                ->where('status', '!=', StatusCustomerEnum::CLOSED->value)
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),

            self::SALES => Visit::selectRaw("$dateSelect, SUM(price) as total")
                ->whereBetween('date', [$start, $end])
                ->where('business_id', Auth::user()->business_id)
                ->where('status', StatusVisitEnum::COMPLETED->value)
                ->groupBy('datez')
                ->pluck('total', 'datez')
                ->toArray(),
        };
    }
}
