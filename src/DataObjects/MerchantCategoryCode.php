<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;

/**
 * MerchantCategoryCode
 */
class MerchantCategoryCode extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '52';
        $this->systemName = 'merchant_category_code';

        $this->validationRules = [
            'value' => [
                'required',
                'numeric',
                'digits:4'
            ]
        ];
    }
}
