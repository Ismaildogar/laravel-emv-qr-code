<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * MerchantId
 */
class MerchantId extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '03';
        $this->systemName = 'merchant_id';

        $this->validationRules = [
            'value' => [
                'required',
                'min:15',
                'max:15',
                new AlphaNumericSpecial
            ]
        ];
    }
}
