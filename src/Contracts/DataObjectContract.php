<?php

namespace aliirfaan\LaravelMuQrCode\Contracts;

use Illuminate\Support\Facades\Validator;

abstract class DataObjectContract
{
    /**
     * id
     *
     * @var string|int
     */
    protected $id = null;
    
    /**
     * title
     *
     * @var string
     */
    protected $title = null;
    
    /**
     * systemName
     *
     * @var string
     */
    protected $systemName = null;
    
    /**
     * Data object value
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
     * Add data object
     *
     * @param $template $template [explicite description]
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
            $data = $this->validate();
        } else {
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
}
