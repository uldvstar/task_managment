<?php

namespace App\Classes\Modules\Tasks\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;

class TaskValidation extends AbstractValidation
{


    /**
     * @param TaskObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'milestone_id' => $object->getMilestoneId(),
            'type_id' => $object->getTypeId(),
            'title' => $object->getTitle(),
            'description' => $object->getDescription(),
            'status' => $object->getStatus(),
            'active' => $object->isActive()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'type_id' => 'required',
            'title' => 'required',
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