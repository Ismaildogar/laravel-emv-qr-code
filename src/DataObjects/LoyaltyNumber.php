<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * LoyaltyNumber
 */
class LoyaltyNumber extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '04';
        $this->systemName = 'loyalty_number';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
