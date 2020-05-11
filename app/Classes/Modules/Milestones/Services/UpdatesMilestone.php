<?php

namespace App\Classes\Modules\Milestones\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;
use App\Models\Milestone;

class UpdatesMilestone extends AbstractUpdateRecord
{

    public function execute(Milestone $model, MilestoneObject $object) {

        $model->project_type = $object->getProjectType();
        $model->name = $object->getName();

        return $this->handler($model);

    }
}