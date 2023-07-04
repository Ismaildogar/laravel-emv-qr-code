<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * BillNumber
 */
class BillNumber extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '01';
        $this->title = 'Bill Number';
        $this->systemName = 'bill_number';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
