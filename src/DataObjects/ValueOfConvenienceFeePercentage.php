<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * ValueOfConvenienceFeePercentage
 * @todo
 * Presence of these data objects depends on the presence and value of the Tip or Convenience Indicator.
 */
class ValueOfConvenienceFeePercentage extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '57';
        $this->title = 'Value Of Convenience Fee Percentage';
        $this->systemName = 'value_of_convenience_fee_percentage';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:5',
                new AlphaNumericSpecial
            ]
        ];
    }
}
