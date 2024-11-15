<?php

namespace App\Enums;

enum StatusBudgetEnum : string
{
    
    case GENERATING = 'generating';
    case GENERATED = 'generated';
    case NOT_GENERATED = 'not_generated';
    case ERROR = 'error';
    case INACTIVE = 'inactive';
 



    public function getName(): ?string{
 
        return match ($this) {
            self::GENERATING => 'Generando',
            self::GENERATED => 'Generado',
            self::NOT_GENERATED => 'No generado',
            self::ERROR => 'Error',
            self::INACTIVE => 'Inactivo',
            default => 'Desconocido',
        };  

    }


    public function getBadgeClasses(): ?string
    {

        return match ($this) {
            self::GENERATING => 'bg-yellow-100 text-yellow-800',
            self::GENERATED => 'bg-green-100 text-green-700',
            self::NOT_GENERATED => 'bg-blue-100 text-blue-700',
            self::ERROR => 'bg-red-100 text-red-700',
            self::INACTIVE => 'bg-gray-100 text-gray-700',
        };
    }


    public function getBadgeFillClasses(): ?string
    {

        return match ($this) {
            self::GENERATING => 'fill-yellow-500',
            self::GENERATED => 'fill-green-500',
            self::NOT_GENERATED => 'fill-blue-500',
            self::ERROR => 'fill-red-500',
            self::INACTIVE => 'fill-gray-500',
        };
    }

    public function getBadgeColorRingClasses(): ?string
    {

        return match ($this) {
            self::GENERATING => 'ring-yellow-700',
            self::GENERATED => 'ring-green-700',
            self::NOT_GENERATED => 'ring-blue-700',
            self::ERROR => 'ring-red-700',
            self::INACTIVE => 'ring-gray-700',
        };
    }





}
