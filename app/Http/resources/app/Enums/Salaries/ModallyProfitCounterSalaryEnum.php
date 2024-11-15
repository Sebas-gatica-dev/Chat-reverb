<?php

namespace App\Enums\Salaries;

enum ModallyProfitCounterSalaryEnum : string
{
    case COUNT = 'count';
    case DAYS = 'days';
    case INFINITY = 'infinity';

    public function getName(): ?string
    {
        return match ($this) {
            self::COUNT => 'Cantidad de trabajos',
            self::DAYS => 'Dias',
            self::INFINITY => 'Infinito',
            default => 'Desconocido',
        };
    }
}