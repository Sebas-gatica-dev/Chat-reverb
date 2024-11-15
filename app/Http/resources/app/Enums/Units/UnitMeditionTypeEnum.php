<?php

namespace App\Enums\Units;

enum UnitMeditionTypeEnum: string
{
    case CENTIMETER = 'centimeter';
    case METER = 'meter';
    case MILLILITER = 'milimeter';
    case GRAM = 'gram';
    case KILOGRAM = 'kilogram';
    case LITER = 'liter';
    case MILLIGRAM = 'milligram';
    case CUBIC_CENTIMETER = 'cubic_centimeter';
    case CUBIC_METER = 'cubic_meter';
    case UNIT = 'unit';
    case USES = 'uses';
    case HOURS = 'hours';

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



    public static function getUnit($unit): ?string
    {
        return match ($unit) {
            self::CENTIMETER->value => 'Centimetro',
            self::METER->value => 'Metro',
            self::MILLILITER->value => 'Mililitro',
            self::GRAM->value => 'Gramo',
            self::KILOGRAM->value => 'Kilogramo',
            self::LITER->value => 'Litro',
            self::MILLIGRAM->value => 'Miligramo',
            self::CUBIC_CENTIMETER->value => 'Centimetro cúbico',
            self::CUBIC_METER->value => 'Metro cúbico',
            self::UNIT->value => 'Unidad',
            self::USES->value => 'usos',
            self::HOURS->value => 'horas',
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

    public function abbreviation(): ?string
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