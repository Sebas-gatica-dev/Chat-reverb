<?php

namespace App\Enums\Units;

enum UnitDownActionReasonTypeEnum: int
{
    case Vencimiento = 0;
    case Rotura = 1;
    case Robo = 3;
    case Perdida = 4;
    case Otro = 5;
  
    public static function getStatus($status): string
    {
        return match ($status) {
            self::Vencimiento => 'Expiro la fecha de vencimiento',
            self::Rotura => 'El insumo esta golpeado, roto o dañado',
            self::Robo => 'El insumo fue robado',
            self::Perdida => 'El insumo fue extraviado',
            self::Otro => 'Ninguna de las anteriores',                    
            default => 'Desconocido',
        };
    }

 
}


// <span class="inline-flex items-center rounded-full {{ UnitsHistoryTypeEnum::getBackgroundColor($status) }} px-2 py-1 text-xs font-medium {{ UnitsHistoryTypeEnum::getTextColor($status) }} ring-1 ring-inset {{ UnitsHistoryTypeEnum::getRingColor($status) }}">
//         {{ UnitsHistoryTypeEnum::getStatus($status) }}
//     </span>