<?php

namespace App\Enums\Salaries;

enum TypeSalaryEnum : string
{
    case SALARY_FIXED = 'salary_fixed';
    case COMMISSIONS = 'commissions';
    case PERCENTAGE = 'percentage';
    case HOURLY = 'hourly';

    public function getName(): ?string
    {
        return match ($this) {
            self::SALARY_FIXED => 'Salario fijo',
            self::COMMISSIONS => 'Comisiones',
            self::PERCENTAGE => 'Porcentaje',
            self::HOURLY => 'Por hora',
            default => 'Desconocido',
        };
    }
}