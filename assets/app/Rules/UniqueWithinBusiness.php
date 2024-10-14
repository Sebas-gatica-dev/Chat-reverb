<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UniqueWithinBusiness implements ValidationRule
{
    protected $model;
    protected $column;
    protected $ignoreId;

    public function __construct(string $model, string $column, $ignoreId = null)
    {
        $this->model = $model;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $businessId = Auth::user()->business_id;
        $model = new $this->model;

        $query = $model->where($this->column, $value)
            ->where('business_id', $businessId);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('El :attribute ya le pertenece a otro usuario en el negocio.');
        }

    }
}
