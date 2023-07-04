<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * LoyaltyNumber
 */
class ReferenceLabel extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '05';
        $this->title = 'Reference Label';
        $this->systemName = 'reference_label';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
