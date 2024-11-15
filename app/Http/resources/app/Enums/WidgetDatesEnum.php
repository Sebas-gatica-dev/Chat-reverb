<?php

namespace App\Enums;

use Carbon\Carbon;

enum WidgetDatesEnum: string
{
    case TODAY = 'today';
    case THIS_WEEK = 'this_week';
    case THIS_MONTH = 'this_month';
    case THIS_YEAR = 'this_year';
    case LAST_7_DAYS = 'last_7_days';
    case LAST_15_DAYS = 'last_15_days';
    case LAST_30_DAYS = 'last_30_days';
    case LAST_6_MONTHS = 'last_6_months';
    case LAST_12_MONTHS = 'last_12_months';

    public function getName(): string
    {
        return match ($this) {
            self::TODAY => 'Hoy',
            self::THIS_WEEK => 'Esta semana',
            self::THIS_MONTH => 'Este mes',
            self::THIS_YEAR => 'Este año',
            self::LAST_7_DAYS => 'Últimos 7 días',
            self::LAST_15_DAYS => 'Últimos 15 días',
            self::LAST_30_DAYS => 'Últimos 30 días',
            self::LAST_6_MONTHS => 'Últimos 6 meses',
            self::LAST_12_MONTHS => 'Últimos 12 meses',
        };
    }

    public function getRange(): string
    {
        return match ($this) {
            self::TODAY, self::THIS_WEEK, self::LAST_7_DAYS, self::LAST_15_DAYS, self::LAST_30_DAYS, self::THIS_MONTH => 'days',
            self::THIS_YEAR, self::LAST_6_MONTHS, self::LAST_12_MONTHS => 'month',
        };
    }


    public function getStartDate(): string
    {
        return match ($this) {
            self::TODAY => Carbon::today()->startOfDay()->format('Y-m-d'),
            self::THIS_WEEK => Carbon::now()->startOfWeek()->format('Y-m-d'),
            self::THIS_MONTH => Carbon::now()->startOfMonth()->format('Y-m-d'),
            self::THIS_YEAR => Carbon::now()->startOfYear()->format('Y-m-d'),
            self::LAST_7_DAYS => Carbon::now()->subDays(6)->startOfDay()->format('Y-m-d'),
            self::LAST_15_DAYS => Carbon::now()->subDays(14)->startOfDay()->format('Y-m-d'),
            self::LAST_30_DAYS => Carbon::now()->subDays(29)->startOfDay()->format('Y-m-d'),
            self::LAST_6_MONTHS => Carbon::now()->subMonths(5)->startOfMonth()->format('Y-m-d'),
            self::LAST_12_MONTHS => Carbon::now()->subMonths(11)->startOfMonth()->format('Y-m-d'),
        };
    }

    public function getEndDate(): string
    {
        return match ($this) {
            self::TODAY => Carbon::today()->endOfDay()->format('Y-m-d'),
            self::THIS_WEEK => Carbon::now()->endOfWeek()->format('Y-m-d'),
            self::THIS_MONTH => Carbon::now()->endOfMonth()->format('Y-m-d'),
            self::THIS_YEAR => Carbon::now()->endOfYear()->format('Y-m-d'),
            self::LAST_7_DAYS, self::LAST_15_DAYS, self::LAST_30_DAYS => Carbon::now()->endOfDay()->format('Y-m-d'),
            self::LAST_6_MONTHS, self::LAST_12_MONTHS => Carbon::now()->endOfMonth()->format('Y-m-d'),
        };
    }

    public function getLabels($start = null, $end = null, $range = null): array
    {
        return match ($range ?? $this->getRange()) {
            'days' => $this->generateDailysNames($start ?? $this->getStartDate(), $end ?? $this->getEndDate()),
            'month' => $this->generateMonthlyNames($start ?? $this->getStartDate(), $end ?? $this->getEndDate()),
        };
    }

    public function getRealDates($start = null, $end = null, $range = null): array
    {
        return match ($range ?? $this->getRange()) {
            'days' => $this->generateDailysDates($start ?? $this->getStartDate(), $end ?? $this->getEndDate()),
            'month' => $this->generateMonthlyDates($start ?? $this->getStartDate(), $end ?? $this->getEndDate()),
        };
    }

    private function generateDailysDates($fechaInicio, $fechaFin): array
    {
        $dates = [];
        $currentDate = Carbon::parse($fechaInicio);

        while ($currentDate->lte($fechaFin)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        return $dates;
    }


    private function generateDailysNames($fechaInicio, $fechaFin): array
    {
        $dates = [];
        $currentDate = Carbon::parse($fechaInicio);

        while ($currentDate->lte($fechaFin)) {
            $dates[] = $currentDate->format('d-m');
            $currentDate->addDay();
        }

        return $dates;
    }

    private function generateMonthlyNames($fechaInicio, $fechaFin): array
    {
        $startDate = Carbon::parse($fechaInicio)->startOfMonth();
        $endDate = Carbon::parse($fechaFin)->endOfMonth();
        $months = [];
        while ($startDate->lte($endDate)) {
            $months[] = ucfirst($startDate->isoFormat('MMMM'));
            $startDate->addMonth();
        }

        return $months;
    }


    private function generateMonthlyDates($fechaInicio, $fechaFin): array
    {
        $dates = [];
        $currentDate = Carbon::parse($fechaInicio);

        while ($currentDate->lte($fechaFin)) {
            $dates[] = $currentDate->format('Y-m');
            $currentDate->addMonth();
        }

        return $dates;
    }
}


