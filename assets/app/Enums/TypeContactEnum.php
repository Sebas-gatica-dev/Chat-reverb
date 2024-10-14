<?php

namespace App\Enums;

enum TypeContactEnum: string
{

    case PHONECALL = 'Llamado telefónico';
    case EMAIL = 'Email';
    case WHATSAPP = 'Whatsapp';
    case IN_PERSON = 'Presencial';
    case OTHER = 'Otro';

}
