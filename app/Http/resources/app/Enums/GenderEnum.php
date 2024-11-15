<?php

namespace App\Enums;

enum GenderEnum : string
{

    case FEMALE = 'female';
    case MALE = 'male';
    case OTHER = 'other';


    public function getName(): ?string{
 
        return match ($this) {
            self::FEMALE => 'Femenino',
            self::MALE => 'Masculino',
            self::OTHER => 'Otro',
            default => 'Desconocido',
        };  

    }

}
