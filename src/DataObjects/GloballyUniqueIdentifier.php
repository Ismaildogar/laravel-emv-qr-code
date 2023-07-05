<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * GloballyUniqueIdentifier
 */
class GloballyUniqueIdentifier extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '00';
        $this->systemName = 'globally_unique_identifier';

        $this->validationRules = [
            'value' => [
                'required',
                'min:1',
                'max:11',
                new AlphaNumericSpecial
            ]
        ];
    }
}
