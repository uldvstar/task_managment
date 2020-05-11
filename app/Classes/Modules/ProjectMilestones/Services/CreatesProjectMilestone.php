<?php

namespace App\Classes\Modules\ProjectMilestones\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;
use App\Models\ProjectMilestone;

class CreatesProjectMilestone extends AbstractUpdateRecord
{

    public function execute(ProjectMilestoneObject $object) {
        $model = new ProjectMilestone();
        $model->project_id = $object->getProjectId();
        $model->name = $object->getName();
        $model->order = $object->getOrder();
        $model->complete = $object->isComplete();

        return $this->handler($model);

    }
}