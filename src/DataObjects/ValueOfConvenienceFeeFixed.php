<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * ValueOfConvenienceFeeFixed
 * @todo
 * Presence of these data objects depends on the presence and value of the Tip or Convenience Indicator.
 */
class ValueOfConvenienceFeeFixed extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '56';
        $this->title = 'Value Of Convenience Fee Fixed';
        $this->systemName = 'value_of_convenience_fee_fixed';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:13',
                new AlphaNumericSpecial
            ]
        ];
    }
}
