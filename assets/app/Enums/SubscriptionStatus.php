<?php

namespace App\Enums;

enum SubscriptionStatus: int
{

    case Expired = 0;
    case Active = 1;
    case Pending = 2;
    case GracePeriod = 3;
    case Cancelled = 4;

    public static function getStatus($status): string
    {
        return match ($status) {
            self::Active => 'Activa',
            self::Expired => 'Expirada',
            self::Pending => 'Pendiente',
            self::GracePeriod => 'Periodo de gracia',
            self::Cancelled => 'Cancelada',
            default => 'Desconocido',
        };
    }

    public static function getBadge($status): string
    {
        return match ($status) {
            self::Active => 'bg-green-500',
            self::Expired => 'bg-red-500',
            self::Pending => 'bg-blue-500',
            self::GracePeriod => 'bg-orange-500',
            self::Cancelled => 'bg-gray-500',
            default => 'bg-slate-500',
        };
    }

    public static function getExpand($status): string
    {
        return match ($status) {
            self::Active => 'bg-green-400',
            self::Expired => 'bg-red-400',
            self::Pending => 'bg-blue-400',
            self::GracePeriod => 'bg-orange-400',
            self::Cancelled => 'bg-gray-400',
            default => 'bg-slate-400',
        };
    }

}
