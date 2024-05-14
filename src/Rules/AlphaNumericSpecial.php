<?php 
namespace aliirfaan\LaravelMuQrCode\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class AlphaNumericSpecial implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Perform validation logic
        return !preg_match('/[^\x20-\x7e]/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not valid.';
    }
}
