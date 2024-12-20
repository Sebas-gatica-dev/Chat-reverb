<?php

namespace App\Enums;

enum ModelTypeEnum: string
{

    case PROPERTY = 'App\Models\Property';
    case USER = 'App\Models\User';
    case TRASH = 'App\Models\Trash';
    case BUSINESS = 'App\Models\Business';
    case ROLE = 'App\Models\Role';
    case PERMISSION = 'App\Models\Permission';
    case VISIT = 'App\Models\Visit';
    case VISIT_TYPE = 'App\Models\VisitType';
    case CUSTOMER = 'App\Models\Customer';
    case PRODUCT = 'App\Models\Product';
    case TICKET = 'App\Models\Ticket';

    public static function getModelType(string $model): string
    {
        return match ($model) {
            self::PROPERTY->value => 'Propiedad',
            self::USER->value => 'Usuario',
            self::TRASH->value => 'Papelera',
            self::BUSINESS->value => 'Negocio',
            self::TICKET->value => 'Ticket',
            self::ROLE->value => 'Rol',
            self::PERMISSION->value => 'Permiso',
            self::VISIT->value => 'Visita',
            self::VISIT_TYPE->value => 'Tipo de visita',
            self::CUSTOMER->value => 'Cliente',
            self::PRODUCT->value => 'Producto',

            default => 'Desconocido', // Valor por defecto para casos no manejados
        };
    }

}
