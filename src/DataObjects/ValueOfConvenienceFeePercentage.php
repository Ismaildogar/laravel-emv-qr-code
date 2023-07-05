<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;

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
        $this->systemName = 'value_of_convenience_fee_percentage';

        $this->validationRules = [
            'value' => [
                'regex:/^\d{1,3}(\.\d{1,2})?$/',
            ]
        ];
    }
}
