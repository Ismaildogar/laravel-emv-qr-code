<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use Illuminate\Validation\Rule;

/**
 * TransactionAmount
 */
class TipOrConvenienceIndicator extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '55';
        $this->systemName = 'tip_or_convenience_indicator';

        $this->validationRules = [
            'value' => [
                'digits:2',
                'numeric',
                Rule::in(['01', '02', '03'])
            ]
        ];
    }
}
