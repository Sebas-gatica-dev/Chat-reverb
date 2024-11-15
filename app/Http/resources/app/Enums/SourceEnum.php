<?php

namespace App\Enums;

enum SourceEnum : string
{

    case FACEBOOK = 'facebook';
    case GOOGLE_ADS = 'google_ads';
    case INSTAGRAM = 'instagram';
    case MERCADOLIBRE = 'mercado_libre';
    case RECOMMENDATION = 'recommendation';
    case TWITTER = 'twitter';
    case ORGANIC = 'organic';
    case OTHER = 'other';



    public function getName(): ?string{
 
        return match ($this) {
            self::FACEBOOK => 'Facebook',
            self::GOOGLE_ADS => 'Google Ads',
            self::INSTAGRAM => 'Instagram',
            self::MERCADOLIBRE => 'Mercado Libre',
            self::RECOMMENDATION => 'Recomendación',
            self::TWITTER => 'Twitter',
            self::ORGANIC => 'Orgánico',
            self::OTHER => 'Otro',
            default => 'Desconocido',
        }; 
         

    }

}
