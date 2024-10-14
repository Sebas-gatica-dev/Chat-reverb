<?php

namespace App\Enums\Units;

enum UnitsHistoryTypeEnum: int
{
    case Alta = 0;
    case Baja = 1;
    case Carga = 2;
    case TransferToWarehouse = 3;
    case TransferToWorker = 4;
    case TransferToOtherUnit = 5;
    case Uso = 6;
    case Agotado = 7;
    case Caduco = 8;
    case ReceiveTransfer = 9;


    public static function getStatus($status): string
    {
        return match ($status) {
            self::Alta => 'Alta de unidad',
            self::Baja => 'Baja de unidad',
            self::Carga => 'Carga',
            self::TransferToWarehouse => 'Transferir unidad a un deposito',
            self::TransferToWorker => 'Transferir unidad a un operario',
            self::TransferToOtherUnit => 'Transferir unidad a otra unidad',            
            self::Uso => 'Uso de unidad',
            self::Agotado => 'Unidad agotada',
            self::Caduco => 'Unidad caducada',
            self::ReceiveTransfer => 'Recibio una transferencia',
            default => 'Desconocido',
        };
    }

    public static function getBackgroundColor($status): string
    {
        return match ($status) {
            self::Alta => 'bg-green-50',
            self::Baja, self::Caduco => 'bg-red-50',
            self::Carga => 'bg-blue-50',
            self::TransferToWarehouse => 'bg-gray-50',
            self::TransferToWorker => 'bg-gray-50',
            self::TransferToOtherUnit => 'bg-gray-50',
            self::Uso => 'bg-purple-50',
            self::Agotado => 'bg-yellow-50',
            default => 'bg-slate-50',
        };
    }

    public static function getTextColor($status): string
    {
        return match ($status) {
            self::Alta => 'text-green-700',
            self::Baja, self::Caduco => 'text-red-700',
            self::Carga => 'text-blue-700',
            self::TransferToWarehouse => 'text-gray-700',
            self::TransferToWorker => 'text-gray-700',
            self::TransferToOtherUnit => 'text-gray-700',
            self::Uso => 'text-purple-700',
            self::Agotado => 'text-yellow-800',
            default => 'text-slate-700',
        };
    }

    public static function getRingColor($status): string
    {
        return match ($status) {
            self::Alta => 'ring-green-600/20',
            self::Baja, self::Caduco => 'ring-red-600/10',
            self::Carga => 'ring-blue-700/10',
            self::TransferToWarehouse => 'ring-gray-500/10',
            self::TransferToWorker => 'ring-gray-500/10',
            self::TransferToOtherUnit => 'ring-gray-500/10',
            self::Uso => 'ring-purple-700/10',
            self::Agotado => 'ring-yellow-600/20',
            default => 'ring-slate-500/10',
        };
    }
}


// <span class="inline-flex items-center rounded-full {{ UnitsHistoryTypeEnum::getBackgroundColor($status) }} px-2 py-1 text-xs font-medium {{ UnitsHistoryTypeEnum::getTextColor($status) }} ring-1 ring-inset {{ UnitsHistoryTypeEnum::getRingColor($status) }}">
//         {{ UnitsHistoryTypeEnum::getStatus($status) }}
//     </span>