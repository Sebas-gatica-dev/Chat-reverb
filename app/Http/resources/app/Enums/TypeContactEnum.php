<?php

namespace App\Enums;

enum TypeContactEnum: string
{

    case PHONECALL = 'phone_call';
    case EMAIL = 'email';
    case WHATSAPP = 'whatsapp';
    case IN_PERSON = 'in_person';
    case OTHER = 'other';

    public function getName(): ?string{
 
        return match ($this) {
            self::PHONECALL => 'Llamado telefónico',
            self::EMAIL => 'Email',
            self::WHATSAPP  => 'Whatsapp',
            self::IN_PERSON  => 'Presencial',
            self::OTHER  => 'Otro',
            default => 'Desconocido'
        };  

    }


    public function getBadgeClasses(): ?string{
    

        return match ($this) {
            self::PHONECALL => 'bg-green-100 text-green-700',
            self::EMAIL => 'bg-blue-100 text-blue-700',
            self::WHATSAPP  => 'bg-green-100 text-green-700',
            self::IN_PERSON  => 'bg-purple-100 text-purple-700',
            self::OTHER  => 'bg-gray-100 text-gray-600',
        };
    }

    
    public function getBadgeFillClasses(): ?string{

        return match ($this) {
            self::PHONECALL => 'fill-green-500',
            self::EMAIL => 'fill-blue-500',
            self::WHATSAPP  => 'fill-green-500',
            self::IN_PERSON  => 'fill-purple-500',
            self::OTHER  => 'fill-gray-400',
        };
    }

}
