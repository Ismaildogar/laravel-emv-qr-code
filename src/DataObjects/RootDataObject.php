<?php

namespace aliirfaan\LaravelMuQrCode\DataObjects;

use aliirfaan\LaravelMuQrCode\Contracts\DataObjectContract;
use aliirfaan\LaravelMuQrCode\DataObjects\PayloadFormatIndicator;
use aliirfaan\LaravelMuQrCode\DataObjects\Crc;

/**
 * RootDataObject
 */
class RootDataObject extends DataObjectContract
{
    public function __construct()
    {
        $this->title = 'Root';
        $this->systemName = 'root';
    }

    public function validate()
    {
        $data = [
            'success' => false,
            'result' => null,
            'errors' => null,
            'message' => null,
            'issues' => [],
        ];

        $data = $this->validateFirstAndLastDataObject();

        if (is_null($data['errors'])) {
            $data = $this->validateChildDataObjects();
        }

        return $data;
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
}
