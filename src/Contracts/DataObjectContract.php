<?php

namespace aliirfaan\LaravelMuQrCode\Contracts;

use Illuminate\Support\Facades\Validator;

/**
 * DataObjectContract
 */
abstract class DataObjectContract
{
    /**
     * The first field is an identifier (ID) by which the data object can be reference
     * The ID is coded as a two-digit numeric value, when a value ranging from "00" to "99"
     *
     * @var string
     */
    protected $id = null;
    
    /**
     * Whether data object is root element
     *
     * @var bool
     */
    protected $isRoot = false;
    
    /**
     * systemName to show errors
     *
     * @var string
     */
    protected $systemName = null;
    
    /**
     * Data object value - The value field has a minimum length of one character and maximum length of 99 characters
     *
     * @var mixed
     */
    protected $value = null;
    
    /**
     * Validation rules for data object value
     *
     * @var array
     */
    protected $validationRules = [];
    
    /**
     * childDataObjects
     *
     * @var array
     */
    protected $childDataObjects = [];
    
    /**
     * Method setValue
     *
     * @param $value $value [explicite description]
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    /**
     * Method getValue
     *
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Method getId
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * A data object may contain other data objects
     * Add data object to data object
     *
     * @param DataObjectContract $dataObject
     *
     * @return void
     */
    public function pushChildDataObject($dataObject)
    {
        $this->childDataObjects[] = $dataObject;
    }
    
    /**
     * Method setValidationRules
     *
     * @param array $rules
     *
     * @return void
     */
    public function setValidationRules($rules)
    {
        $this->validationRules = $rules;
    }
    
    /**
     * Validate data object value
     *
     * @return null|array
     */
    public function validate()
    {
        $data = [
            'success' => false,
            'result' => null,
            'errors' => null,
            'message' => null,
            'issues' => [],
        ];

        if (!is_null($this->value)) {
            $fieldsArray = ['value' => $this->value];
            $validationRules = $this->validationRules;

            $validator = Validator::make($fieldsArray, $validationRules);
            if ($validator->fails()) {
                $data['errors'] = true;
                $data['issues'][$this->systemName] = $validator->errors()->toArray();
            }
        }

        if (is_null($data['errors']) && count($this->childDataObjects) > 0) {
            $data = $this->validateChildDataObjects();
        }

        if (is_null($data['errors'])) {
            $data['success'] = true;
        }

        return $data;
    }

    /**
     * Method validateChildDataObjects
     *
     * @return array
     */
    public function validateChildDataObjects()
    {
        $data = [
            'success' => false,
            'result' => null,
            'errors' => null,
            'message' => null,
            'issues' => [],
        ];
        
        foreach ($this->childDataObjects as $childDataObject) {
            $validateChildDataObjectResponse = $childDataObject->validate();
            if (!$validateChildDataObjectResponse['success']) {
                $data = $validateChildDataObjectResponse;
                break;
            }
        }

        if (is_null($data['errors'])) {
            $data['success'] = true;
        }

        return $data;
    }
    
    /**
     * Get length of the value
     * The length is coded as a two-digit numeric value, with a value ranging from "01" to "99"
     *
     * Left pad with zero so that we get results like '01, 02' in case length is < 10
     *
     * @return string
     */
    public function getValueLength()
    {
        return str_pad(strlen($this->value), 2, '0', STR_PAD_LEFT);
    }
    
    /**
     * A data object is represented as an ID / Length / Value combination
     *
     * @return null|string
     */
    public function getRepresentation()
    {
        $representation = null;
                
        if (count($this->childDataObjects) > 0) {
            $childrenRepresenation = null;
            foreach ($this->childDataObjects as $childDataObject) {
                $childrenRepresenation .= $childDataObject->getRepresentation();
            }
            $this->setValue($childrenRepresenation);
        }

        if (!is_null($this->value)) {
            $representation = $this->value;
            if (!$this->isRoot) {
                $representation = $this->id . $this->getValueLength() . $representation;
            }
        }

        return $representation;
    }
}
