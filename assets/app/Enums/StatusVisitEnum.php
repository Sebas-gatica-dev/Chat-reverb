<?php

namespace App\Enums;

enum StatusVisitEnum : int
{
    case Pending = 0;
    case OnTheWay = 1;
    case AtTheDoor = 2;
    case InProgress = 3;
    case Completed = 4;
    case Rescheduled = 5;
    case Cancelled = 6;
    case Incomplete = 7;

    public static function getStatus($status): string
    {
        return match ($status) {
            self::Pending => 'Pendiente',
            self::OnTheWay => 'En camino',
            self::AtTheDoor => 'En la puerta',
            self::InProgress => 'En progreso',
            self::Completed => 'Completada',
            self::Rescheduled => 'Reprogramada',
            self::Cancelled => 'Cancelada',
            self::Incomplete => 'Incompleta',
            default => 'Desconocido',
        };
    }

    public function getName($status): string
    {
        return match($status) {
            self::Pending => 'Pending',
            self::OnTheWay => 'OnTheWay',
            self::AtTheDoor => 'AtTheDoor',
            self::InProgress => 'InProgress',
            self::Completed => 'Completed',
            self::Rescheduled => 'Rescheduled',
            self::Cancelled => 'Cancelled',
            self::Incomplete => 'Incomplete',
        };
    }
}


