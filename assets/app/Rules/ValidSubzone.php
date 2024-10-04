<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ValidSubzone implements ValidationRule
{
    protected $subzones;

    public function __construct($subzones)
    {
        $this->subzones = $subzones;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (count($this->subzones) > 0) {
            if (empty($value)) {
                $fail('El campo :attribute es obligatorio cuando hay subzonas disponibles.');
                return;
            }

            $exists = DB::table('subzones')->where('id', $value)->exists();
            if (!$exists) {
                $fail('El campo :attribute debe ser un subzona válida.');
            }
        }
    }
}
