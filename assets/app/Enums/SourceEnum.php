<?php

namespace App\Enums;

enum SourceEnum : int
{

    case Facebook = 0;
    case GoogleAds = 1;
    case Instagram = 2;
    case MercadoLibre = 3;
    case Recommendation = 4;
    case Twitter = 5;
    case Organic = 6;
    case Other = 7;



    public static function getSource($source): string
    {
        return match ($source) {
            self::Facebook => 'Facebook',
            self::GoogleAds => 'Google Ads',
            self::Instagram => 'Instagram',
            self::MercadoLibre => 'Mercado Libre',
            self::Recommendation => 'Recomendación',
            self::Twitter => 'Twitter',
            self::Organic => 'Orgánico',
            self::Other => 'Otro',
            default => 'Desconocido',
        };
    }
}
