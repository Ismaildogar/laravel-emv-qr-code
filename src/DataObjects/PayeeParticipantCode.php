<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * PayeeParticipantCode
 */
class PayeeParticipantCode extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '01';
        $this->title = 'Payee Participant Code';
        $this->systemName = 'payee_participant_code';

        $this->validationRules = [
            'value' => [
                'required',
                'min:12',
                'max:12',
                new AlphaNumericSpecial
            ]
        ];
    }
}
