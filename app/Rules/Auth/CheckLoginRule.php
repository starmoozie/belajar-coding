<?php

namespace App\Rules\Auth;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckLoginRule implements ValidationRule
{
    protected $password;

    public function __construct($password)
    {
        $this->password = ['password' => $password];
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!\Auth::attempt([...[$attribute => $value], ...$this->password])) {
            $fail(__('auth.failed'));
        }
    }
}
