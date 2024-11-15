<?php

namespace App\Enums\Tickets;

enum TypeTicketEnum :string 
{

    case EXPENSES = 'expenses';
    case CASH_DEPOSIT = 'cash_deposit';
    case TRANSFER_DEPOSIT = 'transfer_deposit';
    case ADJUSTMENT = 'adjustment';
    case PROFIT = 'profit';
    case ADVANCE = 'advance';


    public function getName(): ?string{
 
        return match ($this) {
            self::EXPENSES => 'Gastos',
            self::CASH_DEPOSIT => 'Deposito en efectivo',
            self::TRANSFER_DEPOSIT => 'Deposito por transferencia',
            self::ADJUSTMENT => 'Ajuste',
            self::PROFIT => 'Ganancia',
            self::ADVANCE => 'Adelanto',
            default => 'Desconocido',
            
        };  

    }

    public function getBadgeClasses(){


        return match ($this) {
            self::EXPENSES => 'bg-red-100 text-red-800',
            self::CASH_DEPOSIT => 'bg-green-100 text-green-800',
            self::TRANSFER_DEPOSIT => 'bg-blue-100 text-blue-800',
            self::ADJUSTMENT => 'bg-yellow-100 text-yellow-800',
            self::PROFIT => 'bg-indigo-100 text-indigo-800',
            self::ADVANCE => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };

    }

    public function getBadgeFillClasses(){

        return match ($this) {

            self::EXPENSES => 'fill-red-500',
            self::CASH_DEPOSIT => 'fill-green-500',
            self::TRANSFER_DEPOSIT => 'fill-blue-500',
            self::ADJUSTMENT => 'fill-yellow-500',
            self::PROFIT => 'fill-indigo-500',
            self::ADVANCE => 'fill-purple-500',
            default => 'fill-gray-500',

        };


    }
    
}
