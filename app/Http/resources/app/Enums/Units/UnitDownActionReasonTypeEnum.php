<?php

namespace App\Enums\Units;

enum UnitDownActionReasonTypeEnum: string
{
    case Vencimiento = 'expiration';
    case Rotura = 'breakage';
    case Robo = 'theft';
    case Perdida = 'loss';
    case Otro = 'other';
  
    public static function getDownActionReason($status): ?string
    {
        return match ($status) {
            self::Vencimiento->value => 'Expiro la fecha de vencimiento',
            self::Rotura->value => 'El insumo esta golpeado, roto o dañado',
            self::Robo->value => 'El insumo fue robado',
            self::Perdida->value => 'El insumo fue extraviado',
            self::Otro->value => 'Ninguna de las anteriores',                    
            default => 'Desconocido',
        };
    }

 
}


// <span class="inline-flex items-center rounded-full {{ UnitsHistoryTypeEnum::getBackgroundColor($status) }} px-2 py-1 text-xs font-medium {{ UnitsHistoryTypeEnum::getTextColor($status) }} ring-1 ring-inset {{ UnitsHistoryTypeEnum::getRingColor($status) }}">
//         {{ UnitsHistoryTypeEnum::getStatus($status) }}
//     </span>