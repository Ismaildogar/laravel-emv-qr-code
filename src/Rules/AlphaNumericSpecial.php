<?php

namespace aliirfaan\LaravelMuQrCode\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Values that can be represented by the Common Character Set as defined in [EMV Book 4]. The Alphanumeric Special alphabet includes ninety-six (96) characters in total and includes the numeric alphabet and punctuation.
 */
class AlphaNumericSpecial implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/[^\x20-\x7e]/', $value)) {
            $fail('The :attribute is not valid.');
        }
    }
}
