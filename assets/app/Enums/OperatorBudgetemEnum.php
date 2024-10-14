<?php

namespace App\Enums;

enum OperatorBudgetemEnum: string
{

    case FIXED = 'Fijo';
    case PERCENTAGE = 'Porcentaje';
    case COUNTABLE = 'Contable';


    public static function fromValue($model) {
     
        return match ($model) {
            self::FIXED->name => self::FIXED->value,
            self::PERCENTAGE->name => self::PERCENTAGE->value,
            self::COUNTABLE->name => self::COUNTABLE->value,
            default => 'Desconocido', // Valor por defecto para casos no manejados
        };
    }

}
