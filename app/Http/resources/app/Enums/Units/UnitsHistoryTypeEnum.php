<?php

namespace App\Enums\Units;

enum UnitsHistoryTypeEnum: string
{
    case Alta = 'high';
    case Baja = 'low';
    case Carga = 'load';
    case TransferToWarehouse = 'transfer_to_warehouse';
    case TransferToWorker = 'transfer_to_worker';
    case TransferToOtherUnit = 'transfer_to_other_unit';
    case Uso = 'use';
    case Agotado = 'depleted';
    case Caduco = 'expired';
    case ReceiveTransfer = 'receive_transfer';


    public static function getStatus($status): string
    {
        return match ($status) {
            self::Alta->value => 'Alta de unidad',
            self::Baja->value => 'Baja de unidad',
            self::Carga->value => 'Carga',
            self::TransferToWarehouse->value => 'Transferir unidad a un deposito',
            self::TransferToWorker->value => 'Transferir unidad a un operario',
            self::TransferToOtherUnit->value => 'Transferir unidad a otra unidad',            
            self::Uso->value => 'Uso de unidad',
            self::Agotado->value => 'Unidad agotada',
            self::Caduco->value => 'Unidad caducada',
            self::ReceiveTransfer->value => 'Recibio una transferencia',
            default => 'Desconocido',
        };
    }

    public static function getBackgroundColor($status): string
    {
        return match ($status) {
            self::Alta->value => 'bg-green-50',
            self::Baja->value => 'bg-red-50', 
            self::Carga->value => 'bg-blue-50',
            self::TransferToWarehouse->value => 'bg-gray-50',
            self::TransferToWorker->value => 'bg-gray-50',
            self::TransferToOtherUnit->value => 'bg-gray-50',
            self::Uso->value => 'bg-purple-50',
            self::Agotado->value => 'bg-yellow-50',
            self::Caduco->value => 'bg-red-50',
            self::ReceiveTransfer->value => 'bg-green-50',
            default => 'bg-slate-50',
        };
    }

    public static function getTextColor($status): string
    {
        return match ($status) {
            self::Alta->value => 'text-green-700',
            self::Baja->value => 'text-red-700',
            self::Carga->value => 'text-blue-700',
            self::TransferToWarehouse->value => 'text-gray-700',
            self::TransferToWorker->value => 'text-gray-700',
            self::TransferToOtherUnit->value => 'text-gray-700',
            self::Uso->value => 'text-purple-700',
            self::Agotado->value => 'text-yellow-800',
            self::Caduco->value => 'text-red-700',
            self::ReceiveTransfer->value => 'text-green-700',
            default => 'text-slate-700',
        };
    }

    public static function getRingColor($status): string
    {
        return match ($status) {
            self::Alta->value => 'ring-green-600/20',
            self::Baja->value => 'ring-red-600/10',
            self::Caduco->value => 'ring-red-600/10',
            self::Carga->value => 'ring-blue-700/10',
            self::TransferToWarehouse->value => 'ring-gray-500/10',
            self::TransferToWorker->value => 'ring-gray-500/10',
            self::TransferToOtherUnit->value => 'ring-gray-500/10',
            self::Uso->value => 'ring-purple-700/10',
            self::Agotado->value => 'ring-yellow-600/20',
            default => 'ring-slate-500/10',
        };
    }



    public static function getDefaultMessage($status): string
    {
        return match ($status) {
            self::Alta->value => 'La unidad ha sido dada de alta y está lista para ser utilizada.',
            self::Baja->value => 'La unidad ha sido dada de baja y ya no está en servicio.',
            self::Carga->value => 'La unidad ha sido cargada con nuevos materiales o productos.',
            self::TransferToWarehouse->value => 'La unidad ha sido transferida a un depósito para su almacenamiento.',
            self::TransferToWorker->value => 'La unidad ha sido transferida a un operario para su uso.',
            self::TransferToOtherUnit->value => 'La unidad ha sido transferida a otra unidad para continuar su operación.',
            self::Uso->value => 'La unidad está actualmente en uso y operativa.',
            self::Agotado->value => 'La unidad está agotada y necesita ser recargada o reemplazada.',
            self::Caduco->value => 'La unidad ha caducado y ya no es apta para su uso.',
            self::ReceiveTransfer->value => 'La unidad ha recibido una transferencia y está lista para su uso.',
            default => 'El estado de la unidad es desconocido.',
        };
    }




}


// <span class="inline-flex items-center rounded-full {{ UnitsHistoryTypeEnum::getBackgroundColor($status) }} px-2 py-1 text-xs font-medium {{ UnitsHistoryTypeEnum::getTextColor($status) }} ring-1 ring-inset {{ UnitsHistoryTypeEnum::getRingColor($status) }}">
//         {{ UnitsHistoryTypeEnum::getStatus($status) }}
//     </span>