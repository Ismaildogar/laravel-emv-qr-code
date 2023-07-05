<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * AdditionalDataField
 */
class AdditionalDataFieldTemplate extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '62';
        $this->systemName = 'additional_data_field';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:99',
                new AlphaNumericSpecial,
            ]
        ];
    }
}
