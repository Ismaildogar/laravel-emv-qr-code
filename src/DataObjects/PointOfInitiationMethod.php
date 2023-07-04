<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use Illuminate\Validation\Rule;

/**
 * PointOfInitiationMethod
 * If present, the Point of Initiation Method shall contain a value of "11" or "12". All other values are RFU.
 * The value of "11" should be used when the same QR Code is shown for more than one transaction and the value of “12” should be used when a new QR Code is shown for each transaction.
 */
class PointOfInitiationMethod extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '01';
        $this->title = 'Point of Initiation Method';
        $this->systemName = 'point_of_initiation_method';

        $this->validationRules = [
            'value' => [
                'numeric',
                'digits:2',
                Rule::in(['11', '12'])
            ]
        ];
    }
}
