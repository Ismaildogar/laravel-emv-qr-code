<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\Rules\AlphaNumericSpecial;
use aliirfaan\LaravelMuQrCode\DataObjects\PayloadFormatIndicator;
use aliirfaan\LaravelMuQrCode\DataObjects\Crc;

use aliirfaan\LaravelMuQrCode\DataObjects\TipOrConvenienceIndicator;
use aliirfaan\LaravelMuQrCode\DataObjects\ValueOfConvenienceFeeFixed;
use aliirfaan\LaravelMuQrCode\DataObjects\ValueOfConvenienceFeePercentage;

/**
 * RootDataObject
 */
class RootDataObject extends DataObjectContract
{
    public function __construct()
    {
        $this->isRoot = true;
        $this->systemName = 'root';
        $this->validationRules = [
            'value' => [
                'min:1',
                'max:512',
                new AlphaNumericSpecial
            ]
        ];
    }

    /**
     * The Payload Format Indicator (ID "00") is the first data object under the root
     * The CRC ID (ID "63") is the last object under the root
     *
     * @return array
     */
    public function validateFirstAndLastDataObject()
    {
        $data = [
            'success' => false,
            'result' => null,
            'errors' => null,
            'message' => null,
            'issues' => [],
        ];

        $firstDataObject = array_key_exists(0, $this->childDataObjects) ?$this->childDataObjects[0] : null;
        $lastDataObject = end($this->childDataObjects);
        if (is_null($firstDataObject)) {
            $data['errors'] = true;
            $data['issues'][$this->systemName] = 'The payload format Indicator is not set.';
        }
        if (is_null($data['errors']) && is_null($lastDataObject)) {
            $data['errors'] = true;
            $data['issues'][$this->systemName] = 'The CRC is not set.';
        }

        if (is_null($data['errors']) && (!$firstDataObject instanceof PayloadFormatIndicator)) {
            $data['errors'] = true;
            $data['issues'][$this->systemName] = 'The payload format indicator is not the first data object under the root.';
        }

        if (is_null($data['errors']) && (!$lastDataObject instanceof Crc)) {
            $data['errors'] = true;
            $data['issues'][$this->systemName] = 'The CRC is not the last object under the root.';
        }

        return $data;
    }
    
    /**
     * generate root representation
     * validate convenience fee
     * calculate crc
     * validate root data object
     *
     * @return array
     */
    public function generateRootRepresentation()
    {
        $data = $this->validateConvenienceFee();
        $representation = null;
        
        if (is_null($data['errors'])) {
            $representation = $this->getRepresentation(); // representation without CRC

            // calculate CRC
            $crc = new Crc();
            $hashString = $representation . $crc->getId() . $crc->getLength();
            $crcHash = $crc->hash($hashString);
            $checksum = strtoupper(dechex($crcHash));
            $crc->setValue($checksum);

            // add crc to root data object
            $this->pushChildDataObject($crc);
        }

        if (is_null($data['errors'])) {
            $data = $this->validateFirstAndLastDataObject();
        }
        
        if (is_null($data['errors'])) {
            $representation = $this->getRepresentation(); // representation with crc

            $data = $this->validate();
            if (is_null($data['errors'])) {
                $data['success'] = true;
                $data['result'] = $representation;
            }
        }

        return $data;
    }
    
    /**
     * validate convenience fee data objects
     *
     * A value of "01" shall be used if the mobile application should prompt the consumer to enter a tip to be paid to the merchant.
     *  A value of "02" shall be used to indicate inclusion of the data object Value of Convenience Fee Fixed (ID "56").
     * A value of “03” shall be used to indicate inclusion of the data object Value of Convenience Fee Percentage (ID “57”).
     *
     * @return array
     */
    public function validateConvenienceFee()
    {
        $data = [
            'success' => false,
            'result' => null,
            'errors' => null,
            'message' => null,
            'issues' => [],
        ];

        $covenienceTipPresence = [
            'tip_or_convenience_indicator_value' => null,
            'value_of_convenience_fee_fixed' => false,
            'value_of_convenience_fee_percentage' => false,
        ];

        if (count($this->childDataObjects) > 0) {
            foreach ($this->childDataObjects as $childDataObject) {
               if ($childDataObject instanceof TipOrConvenienceIndicator) {
                $covenienceTipPresence['tip_or_convenience_indicator_value'] = $childDataObject->getValue();
               } elseif ($childDataObject instanceof ValueOfConvenienceFeeFixed) {
                $covenienceTipPresence['value_of_convenience_fee_fixed'] = true;
               } elseif ($childDataObject instanceof ValueOfConvenienceFeePercentage) {
                $covenienceTipPresence['value_of_convenience_fee_percentage'] = true;
               }
            }

            if (!is_null($covenienceTipPresence['tip_or_convenience_indicator_value'])) {
                $tipOrConvenienceIndicatiorValue = $covenienceTipPresence['tip_or_convenience_indicator_value'];

                if ($tipOrConvenienceIndicatiorValue == '02' && !$covenienceTipPresence['value_of_convenience_fee_fixed']) {
                    $data['errors'] = true;
                    $data['issues'][] = sprintf('Data object Convenience Fee Fixed must be present if Tip Or Convenience Indicator value is %s.', $tipOrConvenienceIndicatiorValue);
                } elseif ($tipOrConvenienceIndicatiorValue == '03' && !$covenienceTipPresence['value_of_convenience_fee_percentage']) {
                    $data['errors'] = true;
                    $data['issues'][] = sprintf('Data object Convenience Fee Percentage must be present if Tip Or Convenience Indicator value is %s.', $tipOrConvenienceIndicatiorValue);
                }
            }
        }

        if (is_null($data['errors'])) {
            $data['success'] = true;
        }

        return $data;
    }
}
