<?php

namespace App\Enums\Salaries;

enum TaxesSalaryEnum : string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
    case NONE = 'none';

    public function getName(): ?string
    {
        return match ($this) {
            self::FIXED => 'Fijo',
            self::PERCENTAGE => 'Porcentaje',
            self::NONE => 'Ninguno',
            default => 'Desconocido',
        };
    }
}