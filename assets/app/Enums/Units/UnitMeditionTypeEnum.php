<?php

namespace App\Enums\Units;

enum UnitMeditionTypeEnum: int
{
    case CENTIMETER = 0;
    case METER = 1;
    case MILLILITER = 2;
    case GRAM = 3;
    case KILOGRAM = 4;
    case LITER = 5;
    case MILLIGRAM = 6;
    case CUBIC_CENTIMETER = 7;
    case CUBIC_METER = 8;
    case UNIT = 9;
    case USES = 10;
    case HOURS = 11;

    // Método para obtener todos los valores del enum
    // public static function values(): array
    // {
    //     return [
    //         self::CENTIMETER->value,
    //         self::METER->value,
    //         self::MILLILITER->value,
    //         self::GRAM->value,
    //         self::KILOGRAM->value,
    //         self::LITER->value,
    //         self::MILLIGRAM->value,
    //         self::CUBIC_CENTIMETER->value,
    //         self::CUBIC_METER->value,
    //         self::UNIT->value,
    //     ];
    // }



    public static function getUnit($unit): string
    {
        return match ($unit) {
            self::CENTIMETER => 'Centimetro',
            self::METER => 'Metro',
            self::MILLILITER => 'Mililitro',
            self::GRAM => 'Gramo',
            self::KILOGRAM => 'Kilogramo',
            self::LITER => 'Litro',
            self::MILLIGRAM => 'Miligramo',
            self::CUBIC_CENTIMETER => 'Centimetro cúbico',
            self::CUBIC_METER => 'Metro cúbico',
            self::UNIT => 'Unidad',
            self::USES => 'usos',
            self::HOURS => 'horas',
            default => 'Desconocido',
        };
    }

        // Método para obtener todos los valores del enum
        // public static function names(): array
        // {
        //     return [
        //         self::CENTIMETER->name,
        //         self::METER->name,
        //         self::MILLILITER->value,
        //         self::GRAM->name,
        //         self::KILOGRAM->name,
        //         self::LITER->name,
        //         self::MILLIGRAM->name,
        //         self::CUBIC_CENTIMETER->name,
        //         self::CUBIC_METER->name,
        //         self::UNIT->name,
        //     ];
        // }


    // public static function label(): string
    // {
    //     return match($this) {
    //         self::CENTIMETER => 'centímetro',
    //         self::METER => 'metro',
    //         self::MILLILITER => 'mililitro',
    //         self::GRAM => 'gramo',
    //         self::KILOGRAM => 'kilogramo',
    //         self::LITER => 'litro',
    //         self::MILLIGRAM => 'miligramo',
    //         self::CUBIC_CENTIMETER => 'centímetro cúbico',
    //         self::CUBIC_METER => 'metro cúbico',
    //         self::UNIT => 'unidad',
    //     };
    // }

    public function abbreviation(): string
    {
        return match($this) {
            self::CENTIMETER => 'cm',
            self::METER => 'm',
            self::MILLILITER => 'ml',
            self::GRAM => 'g',
            self::KILOGRAM => 'kg',
            self::LITER => 'l',
            self::MILLIGRAM => 'mg',
            self::CUBIC_CENTIMETER => 'cm³',
            self::CUBIC_METER => 'm³',
            self::UNIT => 'u',
            self::USES => 'usos',
            self::HOURS => 'horas',
            default => 'Desconocido',
        };
    }
}