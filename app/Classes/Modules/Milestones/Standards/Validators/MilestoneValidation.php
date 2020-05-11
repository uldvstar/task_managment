<?php

namespace App\Classes\Modules\Milestones\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;

class MilestoneValidation extends AbstractValidation
{


    /**
     * @param MilestoneObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'project_type' => $object->getProjectType(),
            'name' => $object->getName()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'project_type' => 'required',
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