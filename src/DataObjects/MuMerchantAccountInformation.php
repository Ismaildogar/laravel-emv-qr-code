<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * MuMerchantAccountInformation
 */
class MuMerchantAccountInformation extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '26';
        $this->title = 'Mu Merchant Account Information';
        $this->systemName = 'mu_merchant_account_information';

        $this->validationRules = [
            'value' => [
                'required',
                'min:1',
                'max:99',
                new AlphaNumericSpecial
            ]
        ];
    }
}
