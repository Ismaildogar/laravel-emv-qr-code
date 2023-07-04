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
        $this->title = 'Merchant Category Code';
        $this->systemName = 'merchant_category_code';

        $this->validationRules = [
            'value' => [
                'required',
                'numeric',
                'min:4',
                'max:4'
            ]
        ];
    }
}
