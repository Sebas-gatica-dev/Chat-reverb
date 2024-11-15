<?php

namespace App\Enums;

enum TypeBudgetemEnum: string
{

    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
    case COUNTABLE = 'countable';

    public function getName(): ?string{
 
        return match ($this) {
            self::FIXED => 'Fijo',
            self::PERCENTAGE => 'Porcentaje',
            self::COUNTABLE => 'Contable',
            default => 'Desconocido'
        };  

    }

    
    public function getBadgeClasses(): ?string{
    

        return match ($this) {
            self::FIXED => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
            self::PERCENTAGE => 'bg-red-50 text-red-700 ring-red-600/10',
            self::COUNTABLE => 'bg-blue-50 text-blue-700 ring-blue-700/10',
            default => 'bg-green-50 text-green-600 ring-green-500/100',
        };
    }




}
