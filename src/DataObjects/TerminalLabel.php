<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * TerminalLabel
 */
class TerminalLabel extends DataObjectContract
{
    public function __construct()
    {
        $this->id = '07';
        $this->title = 'Terminal Label';
        $this->systemName = 'terminal_label';

        $this->validationRules = [
            'value' => [
                'min:1',
                'max:25',
                new AlphaNumericSpecial
            ]
        ];
    }
}
