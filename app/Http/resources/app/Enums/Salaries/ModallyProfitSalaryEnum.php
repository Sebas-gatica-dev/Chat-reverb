<?php

namespace App\Enums\Salaries;

enum ModallyProfitSalaryEnum : string
{
    case OWN = 'own';
    case USERS = 'users';
    case BRANCHES = 'branches';
    case ALL = 'all';

    public function getName(): ?string
    {
        return match ($this) {
            self::OWN => 'Propios',
            self::USERS => 'Otros usuarios',
            self::BRANCHES => 'Sucursales',
            self::ALL => 'Todos',
            default => 'Desconocido',
        };
    }
}