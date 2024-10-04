<?php

namespace App\Enums;

enum AutomaticRoutesStatus : string
{
    case GENERATING = 'Generando';
    case FAILURE = 'Fallo';
    case PROCESSING = 'Procesando';

    case COMPLETED = 'Completado';
}
