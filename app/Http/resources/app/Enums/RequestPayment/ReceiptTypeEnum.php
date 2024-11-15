<?php

namespace App\Enums\RequestPayment;

enum ReceiptTypeEnum : string
{

    case TRANSFER = 'transfer';
    case DEPOSIT = 'deposit';
    case DOWN_PAYMENT = 'down_payment';
    case CHECK = 'check';
    case WITHHOLDING = 'withholding';
    case CARD = 'card';
    case OTHER = 'other';

  

    public function getName(): ?string
    {
        return match ($this) {

            self::TRANSFER => 'Transferencia',
            self::DEPOSIT => 'Depósito',
            self::DOWN_PAYMENT => 'Seña',
            self::CHECK => 'Cheque',
            self::WITHHOLDING => 'Retención',
            self::CARD => 'Tarjeta',
            self::OTHER => 'Otro',
            default => 'Desconocido',
           
        };
    }




}