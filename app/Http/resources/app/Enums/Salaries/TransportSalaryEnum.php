<?php

namespace App\Enums\Salaries;

enum TransportSalaryEnum : string
{
    case FIXED = 'fixed';
    case KILOMETER = 'kilometer';
    case NONE = 'none';

    public function getName(): ?string
    {
        return match ($this) {
            self::FIXED => 'Monto fijo',
            self::KILOMETER => 'Por kilómetro',
            self::NONE => 'Ninguno',
            default => 'Desconocido',
        };
    }
}
 