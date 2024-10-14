<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatPhoneNumber($value),
            set: fn ($value) => str_replace([' ', '-', '(', ')'], '', $value),
        );
    }

    /**
     * Format the phone number value.
     */
    private function formatPhoneNumber($value)
    {
        $cleaned = str_replace([' ', '-', '(', ')'], '', $value);

        if (strlen($cleaned) < 10 || strlen($cleaned) > 11) {
            return $value; // Retornar el valor sin formato si no cumple con las condiciones mínimas
        }

        $hasLeadingZero = substr($cleaned, 0, 1) === '0';
        if ($hasLeadingZero) {
            $cleaned = substr($cleaned, 1); // Remover el 0 inicial para evitar duplicados
        }

        $code = '';
        $localNumber = '';
        $formattedNumber = '';

        if (strlen($cleaned) == 10) {
            // Podría ser un código de área de 2 dígitos + número local de 8 dígitos
            // o un código de área de 3 dígitos + número local de 7 dígitos
            // o un código de área de 4 dígitos + número local de 6 dígitos
            if (substr($cleaned, 0, 2) === '11') {
                // Buenos Aires: código de área de 2 dígitos + número local de 8 dígitos
                $code = '11';
                $localNumber = substr($cleaned, 2);
                $formattedNumber = '0' . $code . ' ' . substr($localNumber, 0, 4) . '-' . substr($localNumber, 4);
            } elseif (in_array(substr($cleaned, 0, 3), ['220', '221', '223', '261', '341', '351', '381'])) {
                // Ciudades grandes con código de área de 3 dígitos
                $code = substr($cleaned, 0, 3);
                $localNumber = substr($cleaned, 3);
                $formattedNumber = '0' . $code . ' ' . substr($localNumber, 0, 3) . '-' . substr($localNumber, 3);
            } else {
                // Localidades pequeñas con código de área de 4 dígitos
                $code = substr($cleaned, 0, 4);
                $localNumber = substr($cleaned, 4);
                $formattedNumber = '0' . $code . ' ' . substr($localNumber, 0, 2) . '-' . substr($localNumber, 2);
            }
        } elseif (strlen($cleaned) == 11 && substr($cleaned, 0, 1) === '9') {
            // Número móvil con prefijo 9: 9 + código de área de 2 dígitos + número local de 8 dígitos
            $code = substr($cleaned, 1, 2);
            $localNumber = substr($cleaned, 3);
            $formattedNumber = '0' . $code . ' ' . substr($localNumber, 0, 4) . '-' . substr($localNumber, 4);
        } else {
            // Asumimos que es un número de teléfono móvil sin prefijo 9
            $code = substr($cleaned, 0, 4);
            $localNumber = substr($cleaned, 4);
            $formattedNumber = '0' . $code . ' ' . substr($localNumber, 0, 2) . '-' . substr($localNumber, 2);
        }

        return $formattedNumber; // Retornar el valor sin formato si no cumple con las condiciones
    }
}
