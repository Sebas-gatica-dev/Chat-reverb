<?php

namespace App\Enums;

enum FrequencyEnum : int
{
    case Diario = 1;
    case Semanal = 2;
    case Quincenal = 3;
    case Mensual = 4;
    case Bimestral = 5;
    case Trimestral = 6;
    case Cuatrimestral = 7;
    case Semestral = 8;
    case Anual = 9;
    case SinFrecuencia = 10;



    public function getName(): ?string
    {

        return match ($this) {
            self::Diario => 'Dario',
            self::Semanal  => 'Semanal',
            self::Quincenal  => 'Quincenal',
            self::Mensual => 'Mensual',
            self::Bimestral  => 'Bimestral',
            self::Trimestral  => 'Trimestral',
            self::Cuatrimestral  => 'Cuatrimestral',
            self::Semestral  => 'Semestral',
            self::Anual  => 'Anual',
            self::SinFrecuencia  => 'Sin Frecuencia',
            default => 'Desconocido'
        };
    }





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
