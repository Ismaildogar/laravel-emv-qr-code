<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * CustomerLabel
 */
class CustomerLabel extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '06';
        $this->title = 'Customer Label';
        $this->systemName = 'customer_label';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
