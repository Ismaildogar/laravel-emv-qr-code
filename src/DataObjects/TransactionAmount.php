<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * TransactionAmount
 * @todo
 * Absent if the mobile application is to prompt the consumer to enter the transaction amount. Present otherwise.
 */
class TransactionAmount extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '54';
        $this->title = 'Transaction Amount';
        $this->systemName = 'transaction_amount';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:13',
                new AlphaNumericSpecial
            ]
        ];
    }
}
