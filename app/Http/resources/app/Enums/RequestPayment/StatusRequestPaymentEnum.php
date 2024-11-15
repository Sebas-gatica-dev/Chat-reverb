<?php

namespace App\Enums\RequestPayment;

enum StatusRequestPaymentEnum: string
{
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case PENDING = 'pending';
    case UNCOLLECTIBLE = 'uncollectible';




    public function getName(): ?string
    {
        return match ($this) {

            self::APPROVED => 'Aprobado',
            self::REJECTED => 'Rechazado',
            self::PENDING => 'Pendiente',
            self::UNCOLLECTIBLE => 'Incobrable',
            default => 'Desconocido',
        };
    }


    public function getBadgeClasses()
    {

        return match ($this) {

            self::APPROVED => 'bg-green-100 text-green-800',
            self::REJECTED => 'bg-red-100 text-red-800',
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::UNCOLLECTIBLE => 'bg-gray-100 text-gray-800',


        };
    }


    public function getBadgeFillClasses()
    {

        return match ($this) {

            self::APPROVED => 'bg-green-500',
            self::REJECTED => 'bg-red-500',
            self::PENDING => 'bg-yellow-500',
            self::UNCOLLECTIBLE => 'bg-gray-500',

        };
    }
}
