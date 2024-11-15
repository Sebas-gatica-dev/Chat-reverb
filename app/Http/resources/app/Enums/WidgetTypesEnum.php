<?php

namespace App\Enums;

enum WidgetTypesEnum: string
{
    case LINE = 'line';
    case BAR = 'bar';
    case PIE = 'pie';
    case DOUGHNUT = 'doughnut';
    case COUNT = 'count';

    public function getName(): string
    {
        return match ($this) {
            self::LINE => 'Linea',
            self::BAR => 'Barra',
            self::PIE => 'Torta',
            self::DOUGHNUT => 'Dona',
            self::COUNT => 'Contador',
        };
    }

}