<?php

namespace App\Enums;

enum SourcesEnum: string
{

    
    case RECOMMENDED = 'Recomendado';
    case GOOGLE = 'Google';
    case INSTAGRAM = 'Instagram';
    case FACEBOOK = 'Facebook';
    case TIKTOK = 'Tik Tok';
    case MERCADOLIBRE = 'Mercado Libre';
    case TELEVISION = 'Televisión';
    case RADIO = 'Radio';
    case OTHER = 'Otro';
}
