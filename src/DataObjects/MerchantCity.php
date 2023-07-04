<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * MerchantName
 */
class MerchantCity extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '60';
        $this->title = 'Merchant City';
        $this->systemName = 'merchant_city';

        $this->validationRules = [
            'value' => [
                'required',
                'min:1',
                'max:15',
                new AlphaNumericSpecial
            ]
        ];
    }
}
