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
    protected $id;
    
    /**
     * title
     *
     * @var string
     */
    protected $title;
    
    /**
     * systemName
     *
     * @var string
     */
    protected $systemName;
    
    /**
     * Data object value
     *
     * @var mixed
     */
    protected $value;
    
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
        $fieldsArray = ['value' => $this->value];
        $validationRules = $this->validationRules;
        $errors = null;

        $validator = Validator::make($fieldsArray, $validationRules);
        if ($validator->fails()) {
            $errors[$this->systemName] = $validator->errors()->toArray();
        }

        return $errors;
    }
}
