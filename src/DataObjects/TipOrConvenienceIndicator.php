<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;

/**
 * TransactionAmount
 */
class TipOrConvenienceIndicator extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '55';
        $this->title = 'Tip Or Convenience Indicator';
        $this->systemName = 'tip_or_convenience_indicator';

        $this->validationRules = [
            'value' => [
                'digits:2',
                'numeric'
            ]
        ];
    }
}
