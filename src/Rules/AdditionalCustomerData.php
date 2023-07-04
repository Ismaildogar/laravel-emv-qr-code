<?php

namespace  aliirfaan\LaravelMuQrCode\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * One or more of the following characters may appear in the Additional Consumer Data Request (ID "09"), to indicate that the corresponding data should be provided in the transaction initiation to complete the transactio
 * "A" = Address of the consumer
 * "M" = Mobile number of the consumer
 * "E" = Email address of the consumer
 *
 * If more than one character is included, it means that each data object corresponding to the character is required to complete the transaction. Note that each unique character should appear only once.
 */

class AdditionalCustomerData implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $allowedCharacters = ['A', 'M', 'E'];
        $checkedCharacters = [];

        $valueLength = strlen($value);
        $isSuccess = true;

        for ($i=0; $i<$valueLength; $i++) {
            if (!(in_array($value[$i], $allowedCharacters)) || (array_key_exists($value[$i], $checkedCharacters))) {
                $isSuccess = false;
                break;
            } else {
                $checkedCharacters[$value[$i]] = $value[$i];
            }
        }

        if (!$isSuccess) {
            $fail('The :attribute is not valid.');
        }
    }
}
