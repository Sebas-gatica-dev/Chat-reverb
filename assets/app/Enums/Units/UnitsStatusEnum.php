<?php

namespace App\Enums\Units;

enum UnitsStatusEnum: int
{
    case NEW = 0;
    case USED = 1;
    case DEPLETED = 2;
    case EXPIRED = 3;
    case DISCHARGUED = 4;

    // Método para obtener todos los valores del enum
    // public static function values(): array
    // {
    //     return [
    //         self::NEW->value,
    //         self::USED->value,
    //         self::DEPLETED->value,
    //         self::EXPIRED->value,
    //     ];
    // }

    // Método para obtener una descripción legible por humanos
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
    public static function getColor($status): string
    {
        return match ($status) {
            self::NEW->value => 'green',
            self::USED->value => 'blue',
            self::DEPLETED->value => 'orange',
            self::EXPIRED->value => 'red',
            self::DISCHARGUED->value => 'gray',
        };
    }
    
}