<?php

namespace App\Classes\Modules\Departments\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;

class DepartmentValidation extends AbstractValidation
{


    /**
     * @param DepartmentObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'head_id' => $object->getHeadId()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'name' => 'required'
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }

}