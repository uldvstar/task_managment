<?php

namespace App\Classes\Modules\MilestoneTasks\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;

class MilestoneTaskValidation extends AbstractValidation
{


    /**
     * @param MilestoneTaskObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'milestone_id' => $object->getMilestoneId(),
            'type_id' => $object->getTypeId(),
            'title' => $object->getTitle(),
            'description' => $object->getDescription()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'milestone_id' => 'required',
            'type_id' => 'required',
            'title' => 'required'
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }

}