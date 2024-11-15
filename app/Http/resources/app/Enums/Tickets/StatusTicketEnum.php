<?php

namespace App\Enums\Tickets;

enum StatusTicketEnum : string
{
    
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case REJECTED = 'rejected';




    public function getName(): ?string{
 
        return match ($this) {
            self::APPROVED => 'Aprobado',
            self::PENDING => 'Pendiente',
            self::REJECTED => 'Rechazado',
            default => 'Desconocido',
        };  

    }


}
