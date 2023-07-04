<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * PostalCode
 */
class PostalCode extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '61';
        $this->title = 'Postal Code';
        $this->systemName = 'postal_Code';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:10',
                new AlphaNumericSpecial
            ]
        ];
    }
}
