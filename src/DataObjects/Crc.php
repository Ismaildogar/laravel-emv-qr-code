<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * Crc
 */
class Crc extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '63';
        $this->systemName = 'crc';

        $this->validationRules = [
            'value' => [
                'required',
                'min:4',
                'max:4',
                new AlphaNumericSpecial
            ]
        ];
    }
}
