<?php

namespace App\Classes\Modules\ProjectMilestones\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;

class ProjectMilestoneValidation extends AbstractValidation
{


    /**
     * @param ProjectMilestoneObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'project_id' => $object->getProjectId(),
            'name' => $object->getName(),
            'order' => $object->getOrder(),
            'complete' => $object->isComplete()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'project_id' => 'required',
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