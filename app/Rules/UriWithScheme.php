<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Uri;
use Illuminate\Contracts\Validation\ValidationRule;

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
