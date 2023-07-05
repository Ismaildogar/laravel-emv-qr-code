<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * CountryCode
 */
class CountryCode extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '58';
        $this->systemName = 'country_code';
        $this->value = 'MU';

        $this->validationRules = [
            'value' => [
                'required',
                'min:2',
                'max:2',
                new AlphaNumericSpecial
            ]
        ];
    }
}
