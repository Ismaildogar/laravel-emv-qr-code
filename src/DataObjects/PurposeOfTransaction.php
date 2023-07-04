<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * TerminalLabel
 */
class PurposeOfTransaction extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '08';
        $this->title = 'Purpose Of Transaction';
        $this->systemName = 'purpose_of_transaction';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
