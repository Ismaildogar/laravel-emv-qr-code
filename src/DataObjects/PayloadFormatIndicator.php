<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;
use Illuminate\Validation\Rule;


use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;

/**
 * PayloadFormatIndicator
 * Must be the first element in root data object
 */
class PayloadFormatIndicator extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '00';
        $this->systemName = 'payload_format_indicator';
        $this->value = '01';

        $this->validationRules = [
            'value' => [
                'required',
                'numeric',
                'digits:2',
                Rule::in(['01', '02', '03'])
            ]
        ];
    }
}
