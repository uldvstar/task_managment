<?php

namespace App\Classes\Modules\ModularTypes\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;

class ModularTypeValidation extends AbstractValidation
{


    /**
     * @param ModularTypeObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'module_type' => $object->getModuleType(),
            'name' => $object->getName(),
            'reference' => $object->getReference(),
            'description' => $object->getDescription()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'module_type' => 'required',
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