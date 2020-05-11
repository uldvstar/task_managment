<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Models\MilestoneTaskAssignee;

class UpdatesMilestoneTaskAssignee extends AbstractUpdateRecord
{

    public function execute(MilestoneTaskAssignee $model, MilestoneTaskAssigneeObject $object) {

        $model->assignee_id = $object->getAssigneeId();
        $model->assignee_type = $object->getAssigneeType();
        $model->assignment_id = $object->getAssignmentId();

        return $this->handler($model);

    }
}