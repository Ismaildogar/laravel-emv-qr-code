<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;
use aliirfaan\LaravelMuQrCode\Rules\AdditionalCustomerData;

/**
 * AdditionalCustomerDataRequest
 */
class AdditionalCustomerDataRequest extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '09';
        $this->title = 'Additional Customer Data Request';
        $this->systemName = 'additional_customer_data_request';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AdditionalCustomerData,
                new AlphaNumericSpecial,
            ]
        ];
    }
}
