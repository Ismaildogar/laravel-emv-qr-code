<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;

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
        $this->systemName = 'value_of_convenience_fee_fixed';

        $this->validationRules = [
            'value' => [
                'regex:/^\d{1,13}(\.\d{1,2})?$/',
            ]
        ];
    }
}
