<?php

namespace App\Enums;

enum ProductTypeEnum: string
{
    case SINGLE_USE = 'single_use';
    case ADMINISTRABLE = 'administrable';
    case INFINITE = 'infinite';


    public static function getType($type): string
    {
     
        return match ($type) {

            
            self::SINGLE_USE->value => 'Unico uso',
            self::ADMINISTRABLE->value => 'Administrable',
            self::INFINITE->value => 'Usos infinitos',
            default => 'Desconocido',
        };
        // dd(self::SINGLE_USE, $type);
    }

}
