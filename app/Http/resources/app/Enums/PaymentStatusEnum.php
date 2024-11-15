<?php

namespace App\Enums;

enum PaymentStatusEnum: int
{

    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;

    public static function getStatus($status): string
    {
        return match ($status) {
            self::Pending => 'Pendiente',
            self::Approved => 'Aprobado',
            self::Rejected => 'Rechazado',
        };
    }

    public static function getBadge($status): string
    {
        return match ($status) {
            self::Pending => 'text-blue-700 bg-blue-50 ring-blue-600/20',
            self::Approved => 'text-green-700 bg-green-50 ring-green-600/20',
            self::Rejected => 'text-red-700 bg-red-50 ring-red-600/20',
        };
    }



}
