<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class QuantityWithinRange implements ValidationRule
{
    private $min;
    private $max;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_null($this->min) && !is_null($this->max)) {
            if ($value < $this->min || $value > $this->max) {
                $fail("La cantidad por defecto debe estar entre {$this->min} y {$this->max}.");
            }
        }
    }
}
