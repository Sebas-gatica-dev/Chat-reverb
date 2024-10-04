<?php

namespace App\Enums;

enum FrequencyEnum : int
{
    case Diario = 0;
    case Semanal = 1;
    case Quincenal = 2;
    case Mensual = 3;
    case Bimestral = 4;
    case Trimestral = 5;
    case Cuatrimestral = 6;
    case Semestral = 7;
    case Anual = 8;
    case SinFrecuencia = 9;

    public static function getFrequency($frequency): string
    {



        return match ($frequency) {

            self::Diario => 'Diario',
            self::Semanal => 'Semanal',
            self::Quincenal => 'Quincenal',
            self::Mensual => 'Mensual',
            self::Bimestral => 'Bimestral',
            self::Trimestral => 'Trimestral',
            self::Cuatrimestral => 'Cuatrimestral',
            self::Semestral => 'Semestral',
            self::Anual => 'Anual',
            self::SinFrecuencia => 'Sin Frecuencia',
            default => 'Desconocido',
        };
    }
}
