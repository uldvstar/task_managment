<?php

namespace App\Classes\Modules\TaskAssignees\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;

class TaskAssigneeValidation extends AbstractValidation
{


    /**
     * @param TaskAssigneeObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'assignee_id' => $object->getAssigneeId(),
            'assignee_type' => $object->getAssigneeType(),
            'assignment_id' => $object->getAssignmentId()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'assignee_id' => 'required',
            'assignee_type' => 'required',
            'assignment_id' => 'required'
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }

}