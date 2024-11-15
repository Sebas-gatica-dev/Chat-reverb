<?php

namespace App\Enums;

enum PaymentMethodEnum : string
{
    case Pending = 'pending';
    case Cash = 'cash';
    case Card = 'card';
    case Transfer = 'transfer';
    case Deposit = 'deposit';
    case Check = 'check';
    case MercadoPago = 'mercado_pago';
    case MultiplePayment = 'multiple_payment';
    case NoPayment = 'no_payment';
    case Other = 'other';

    public function getName(): ?string{
        return match ($this) {
            self::Pending => 'Pendiente',
            self::Cash => 'Efectivo',
            self::Card => 'Tarjeta',
            self::Transfer => 'Transferencia',
            self::Deposit => 'Depósito',
            self::Check => 'Cheque',
            self::MercadoPago => 'Mercado Pago',
            self::MultiplePayment => 'Pago Múltiple',
            self::NoPayment => 'Sin Pago',
            self::Other => 'Otro',
            default => 'Desconocido',
        };  
    }

}
