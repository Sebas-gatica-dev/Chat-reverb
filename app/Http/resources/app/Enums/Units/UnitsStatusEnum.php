<?php

namespace App\Enums\Units;

enum UnitsStatusEnum: string
{
    case NEW = 'new';
    case USED = 'used';
    case DEPLETED = 'depleted';
    case EXPIRED = 'expired';
    case DISCHARGUED = 'discharged';

    public static function getStatus($status): string
    {
        return match ($status) {
            self::NEW->value => 'Sin uso',
            self::USED->value => 'Usado',
            self::DEPLETED->value => 'Desechado',
            self::EXPIRED->value => 'Vencido',
            self::DISCHARGUED->value => 'Dado de baja',
        };
    }

    public function getName(): ?string
    {
        return match ($this) {
            self::NEW => 'Sin uso',
            self::USED => 'Usado',
            self::DEPLETED => 'Desechado',
            self::EXPIRED => 'Vencido',
            self::DISCHARGUED => 'Dado de baja',
        };
    }

    public function getBadgeClass(): ?string
    {
        return match ($this) {
            self::NEW => 'green',
            self::USED => 'blue',
            self::DEPLETED => 'orange',
            self::EXPIRED => 'red',
            self::DISCHARGUED => 'red',
        };
    }


    public  function getBackgroundColor(): string
    {
        return match ($this) {
            self::NEW => 'bg-green-50',
            self::USED => 'bg-blue-50',
            self::DEPLETED => 'bg-red-50',
            self::EXPIRED => 'bg-red-50',
            self::DISCHARGUED => 'bg-red-50',
        };
    }

    public  function getTextColor(): string
    {
        return match ($this) {
            self::NEW => 'text-green-700',
            self::USED => 'text-blue-700',
            self::DEPLETED => 'text-orange-700',
            self::EXPIRED => 'text-red-700',
            self::DISCHARGUED => 'text-red-700',
        };
    }

    public  function getRingColor(): string
    {
        return match ($this) {
            self::NEW => 'ring-green-600/20',
            self::USED => 'ring-blue-600/10',
            self::DEPLETED => 'ring-red-600/10',
            self::EXPIRED => 'ring-red-600/10',
            self::DISCHARGUED => 'ring-red-600/10',

    };
    }



}