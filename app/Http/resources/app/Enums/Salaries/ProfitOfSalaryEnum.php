<?php

namespace App\Enums\Salaries;

enum ProfitOfSalaryEnum : string
{
    case WORKS = 'works';
    case CUSTOMERS = 'customers';

    public function getName(): ?string
    {
        return match ($this) {
            self::WORKS => 'Trabajos realizados',
            self::CUSTOMERS => 'Clientes cerrados',
            default => 'Desconocido',
        };
    }
}