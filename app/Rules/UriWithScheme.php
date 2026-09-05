<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Uri;
use Illuminate\Translation\PotentiallyTranslatedString;

class UriWithScheme implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parsed = Uri::of($value);
        if ($parsed->scheme() === null) {
            $fail('The '.$attribute.' must have a scheme.');
        }
    }
}
