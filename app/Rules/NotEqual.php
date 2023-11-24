<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotEqual implements ValidationRule
{
    private mixed $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === $this->value) {
            $fail('The :attribute must not equal ' + $this->value + '.');
        }
    }
}
