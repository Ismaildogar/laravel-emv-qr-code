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
        $this->title = 'Globally Unique Identifier';
        $this->systemName = 'globally_unique_identifier';

        $this->validationRules = [
            'value' => [
                'required',
                'min:11',
                'max:11',
                new AlphaNumericSpecial
            ]
        ];
    }
}
