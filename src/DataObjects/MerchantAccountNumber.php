<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * MerchantAccountNumber
 */
class MerchantAccountNumber extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '02';
        $this->systemName = 'merchant_account_number';

        $this->validationRules = [
            'value' => [
                'required',
                'min:1',
                'max:38',
                new AlphaNumericSpecial
            ]
        ];
    }
}
