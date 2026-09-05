<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Uri;

class UriWithScheme implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parsed = Uri::of($value);
        if ($parsed->scheme() === null) {
            $fail('The '.$attribute.' must have a scheme.');
        }
    }
}
