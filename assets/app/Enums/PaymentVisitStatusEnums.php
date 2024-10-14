<?php

namespace App\Enums;

enum PaymentVisitStatusEnums : int
{
    case Pending = 0;
    case Paid = 1;
    case Partial = 2;
    case Uncollectible = 3;
    case Rejected = 4;
    case Verified = 5;


    public static function getStatus($status): string
    {
        return match ($status) {
            self::Pending => 'Pendiente',
            self::Paid => 'Pagado',
            self::Partial => 'Parcial',
            self::Uncollectible => 'Incobrable',
            self::Rejected => 'Rechazado',
            self::Verified => 'Verificado',
            default => 'Desconocido',
        };
    }
}
