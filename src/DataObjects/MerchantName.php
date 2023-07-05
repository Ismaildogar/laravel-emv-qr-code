<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * MerchantName
 */
class MerchantName extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '59';
        $this->systemName = 'merchant_name';

        $this->validationRules = [
            'value' => [
                'required',
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
