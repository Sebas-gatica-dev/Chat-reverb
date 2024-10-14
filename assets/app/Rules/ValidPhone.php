<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = str_replace([' ', '-', '(', ')'], '', $value);

        // En Argentina, los números de teléfono suelen tener entre 10 y 13 dígitos incluyendo el código de área
        if (!preg_match('/^\d{10,13}$/', $value)) {
            $fail('El campo :attribute debe ser un número de teléfono válido.');
        }
    }
}
