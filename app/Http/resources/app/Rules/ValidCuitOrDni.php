<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCuitOrDni implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = str_replace(['-', '.'], '', $value);

        if (!$this->isValidDni($value) && !$this->isValidCuit($value)) {
            $fail('El campo :attribute debe ser un CUIT o DNI válido.');
        }
    }

    private function isValidDni($dni)
    {
        // El DNI en Argentina tiene entre 7 y 8 dígitos
        return preg_match('/^\d{7,8}$/', $dni);
    }

    private function isValidCuit($cuit)
    {
        // El CUIT en Argentina tiene 11 dígitos
        if (strlen($cuit) !== 11 || !ctype_digit($cuit)) {
            return false;
        }

        $digits = str_split($cuit);
        $sum = 0;
        $weights = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 10; $i++) {
            $sum += $digits[$i] * $weights[$i];
        }

        $verifier = 11 - ($sum % 11);
        $verifier = $verifier === 11 ? 0 : $verifier;
        $verifier = $verifier === 10 ? 9 : $verifier;

        return $digits[10] == $verifier;
    }
}
