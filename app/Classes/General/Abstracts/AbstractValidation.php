<?php

namespace App\Classes\General\Abstracts;


use App\Classes\Exceptions\RequestValidationException;
use App\Classes\Interfaces\DataTransferObject;
use Illuminate\Support\Facades\Validator;

abstract class AbstractValidation
{

    /** @var Validator */
    private $validator;

    /**
     * AbstractValidation constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }


    abstract protected function data($object): array;

    abstract protected function rules(): array;

    abstract protected function messages(): array;


    /**
     * @param DataTransferObject $object
     * @return bool
     * @throws RequestValidationException
     */
    public function validate(DataTransferObject $object){

        $validator = $this->validator::make($this->data($object), $this->rules(), $this->messages());

        if($validator->fails()){
            throw new RequestValidationException($validator->messages()->first());
        }

        return true;
    }

}