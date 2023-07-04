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
        $this->title = 'Merchant Account Number';
        $this->systemName = 'merchant_account_number';

        $this->validationRules = [
            'value' => [
                'required',
                'min:38',
                'max:38',
                new AlphaNumericSpecial
            ]
        ];
    }
}
