<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * MobileNumber
 */
class MobileNumber extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '02';
        $this->systemName = 'mobile_number';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
