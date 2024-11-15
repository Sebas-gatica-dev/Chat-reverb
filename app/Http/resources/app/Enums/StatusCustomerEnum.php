<?php

namespace App\Enums;

enum StatusCustomerEnum: string
{
    case IN_PROCESS = 'in_process';
    case TO_VISIT = 'to_visit';
    case VISITED = 'visited';
    case BUDGETED = 'budgeted';
    case CLOSED = 'closed';
    case NOT_CLOSED = 'not_closed';


    public function getName(): ?string
    {

        return match ($this) {
            self::IN_PROCESS => 'En proceso',
            self::TO_VISIT  => 'A visitar',
            self::VISITED  => 'Visitado',
            self::BUDGETED => 'Presupuestado',
            self::CLOSED  => 'Concretado',
            self::NOT_CLOSED  => 'No concretado',
            default => 'Desconocido'
        };
    }


    public function getBadgeClasses(): ?string
    {

        return match ($this) {
            self::IN_PROCESS => 'bg-yellow-100 text-yellow-800',
            self::TO_VISIT  => 'bg-indigo-100 text-indigo-700',
            self::VISITED  => 'bg-orange-100 text-orange-700',
            self::BUDGETED => 'bg-blue-100 text-blue-700',
            self::CLOSED  => 'bg-green-100 text-green-700',
            self::NOT_CLOSED  => 'bg-red-100 text-red-700',
        };
    }


    public function getBadgeFillClasses(): ?string
    {

        return match ($this) {
            self::IN_PROCESS => 'fill-yellow-500',
            self::TO_VISIT  => 'fill-indigo-500',
            self::VISITED  => 'fill-orange-500',
            self::BUDGETED => 'fill-blue-500',
            self::CLOSED  => 'fill-green-500',
            self::NOT_CLOSED  => 'fill-red-500'
        };
    }


    public function getIcon(): string
    {
        return match ($this) {
            self::IN_PROCESS => '<svg class="w-3.5 h-3.5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                            </svg>',

            self::TO_VISIT => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 ">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
</svg>',
            self::VISITED => '<svg class="w-3.5 h-3.5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                        </svg>',
            self::BUDGETED => '<svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
        </svg>',
            self::CLOSED => '<svg ...>...</svg>',
            default => '<svg ...>...</svg>',
        };
    }





    public function getDescription(): string
    {
        return match ($this) {
            self::IN_PROCESS => 'El lead está en proceso.',
            self::BUDGETED => 'El lead ha sido presupuestado.',
            self::TO_VISIT => 'Pendiente de visita de inspección.',
            self::VISITED => 'Visita de inspección realizada.',
            self::CLOSED => 'El lead se ha concretado.',
            default => '',
        };
    }
}
