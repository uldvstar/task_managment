<?php

namespace App\Classes\Modules\Projects\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;

class ProjectValidation extends AbstractValidation
{


    /**
     * @param ProjectObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'type_id' => $object->getTypeId(),
            'client_id' => $object->getClientId(),
            'reference' => $object->getReference(),
            'description' => $object->getDescription(),
            'status' => $object->getStatus()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'type_id' => 'required',
            'client_id' => 'required',
            'reference' => 'required',
            'status' => 'required'
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }

}