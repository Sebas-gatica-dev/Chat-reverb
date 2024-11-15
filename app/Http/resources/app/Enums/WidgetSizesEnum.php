<?php

namespace App\Enums;

enum WidgetSizesEnum: string
{
    case EXTRA_SMALL = 'extra_small';   // 2
    case VERY_SMALL = 'very_small';     // 3
    case SMALL = 'small';               // 4
    case MEDIUM = 'medium';             // 6
    case LARGE = 'large';               // 8
    case VERY_LARGE = 'very_large';     // 10
    case FULL = 'full';                 // 12


    public function getName(): string
    {
        return match ($this) {
            self::EXTRA_SMALL => 'Extra Chico',
            self::VERY_SMALL => 'Muy Chico',
            self::SMALL => 'Chico',
            self::MEDIUM => 'Mediano',
            self::LARGE => 'Grande',
            self::VERY_LARGE => 'Muy Grande',
            self::FULL => 'Completo',
        };
    }

    public function getColSpan(): string
    {
        return match ($this) {
            self::EXTRA_SMALL => 'col-span-2',
            self::VERY_SMALL => 'col-span-3',
            self::SMALL => 'col-span-4',
            self::MEDIUM => 'col-span-6',
            self::LARGE => 'col-span-8',
            self::VERY_LARGE => 'col-span-10',
            self::FULL => 'col-span-12',
        };
    }
}
