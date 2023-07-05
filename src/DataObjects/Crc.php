<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;

/**
 * Crc
 *
 * The checksum shall be calculated according to [ISO/IEC 13239] using the polynomial '1021' (hex) and initial value 'FFFF' (hex). The data over which the checksum is calculated shall cover all data objects, including their ID, Length and Value, to be included in the QR Code, in their respective order, as well as the ID and Length of the CRC itself (but excluding its Value).
 *
 * Following the calculation of the checksum, the resulting 2-byte hexadecimal value shall be encoded as a 4-character Alphanumeric Special value by converting each nibble to an Alphanumeric Special character.
 *
 * Example: a CRC with a two-byte hexadecimal value of '007B' is included in the QR Code as "6304007B"
 */
class Crc extends DataObjectContract
{
    /**
     * data object length
     * we are using it only for CRC
     *
     * @var string
     */
    private $length = '04';
    
    public function __construct()
    {
        $this->id = '63';
        $this->systemName = 'crc';

        $this->validationRules = [
            'value' => [
                'required',
                'min:4',
                'max:4',
                new AlphaNumericSpecial
            ]
        ];
    }
    
    /**
     * Method getLength
     *
     * @return void
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param string $str
     * @param int $polynomial
     * @param int $initValue
     * @param int $xOrValue
     * @param bool $inputReverse
     * @param bool $outputReverse
     * @return int
     */
    public function hash($str, $polynomial = 0x1021, $initValue = 0xffff, $xOrValue = 0, $inputReverse = false, $outputReverse = false)
    {
        $crc = $initValue;

        for ($i = 0; $i < strlen($str); $i++) {
            if ($inputReverse) {
                $c = ord(self::reverseChar($str[$i]));
            } else {
                $c = ord($str[$i]);
            }
            $crc ^= ($c << 8);
            for ($j = 0; $j < 8; ++$j) {
                if ($crc & 0x8000) {
                    $crc = (($crc << 1) & 0xffff) ^ $polynomial;
                } else {
                    $crc = ($crc << 1) & 0xffff;
                }
            }
        }
        if ($outputReverse) {
            $ret = pack('cc', $crc & 0xff, ($crc >> 8) & 0xff);
            $ret = self::reverseString($ret);
            $arr = unpack('vshort', $ret);
            $crc = $arr['short'];
        }
        return $crc ^ $xOrValue;
    }
}
