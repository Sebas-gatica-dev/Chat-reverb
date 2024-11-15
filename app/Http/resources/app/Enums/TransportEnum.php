<?php

namespace App\Enums;

enum TransportEnum : string
{
    case CAR = 'car';
    case BIKE = 'bike';
    case MOTORCYCLE = 'motorcycle';
    case BUS = 'bus';


    public static function getTransport($frequency): string
    {
        return match ($frequency) {
            self::CAR => 'Auto',
            self::BIKE => 'Bicicleta',
            self::MOTORCYCLE => 'Moto',
            self::BUS => 'Colectivo',
        };
    }
}
