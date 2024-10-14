<?php

namespace App\Enums;

enum StatusLedEnum: string
{

    
    case IN_PROCESS = 'En proceso';
    case BUDGETED = 'Presupuestado';
    case TO_VISIT = 'A visitar';
    case COMPLETED = 'Concretado';
    case NOT_COMPLETED = 'No concretado';

}
