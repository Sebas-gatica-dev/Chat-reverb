<?php

namespace App\Enums;

enum PaymentMethodEnum : int
{
    case Cash = 0;
    case Card = 1;
    case Transfer = 2;
    case Deposit = 3;
    case Check = 4;
    case MercadoPago = 5;
    case MultiplePayment = 6;
    case Other = 7;

    public static function getMethod($method): string
    {
        return match ($method) {
            self::Cash => 'Efectivo',
            self::Card => 'Tarjeta',
            self::Transfer => 'Transferencia',
            self::Deposit => 'Depósito',
            self::Check => 'Cheque',
            self::MercadoPago => 'Mercado Pago',
            self::MultiplePayment => 'Pago Múltiple',
            self::Other => 'Otro',
            default => 'Desconocido',
        };
    }
}
