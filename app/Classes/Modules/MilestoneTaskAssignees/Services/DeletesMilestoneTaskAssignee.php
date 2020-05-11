<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Services;

use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Models\Department;
use App\Models\MilestoneTask;

class DeletesMilestoneTaskAssignee
{

    /**
     * @param MilestoneTaskAssigneeObject $object
     * @return mixed
     */
    public function execute(MilestoneTaskAssigneeObject $object) {
        $model = MilestoneTask::find($object->getAssignmentId());
        $object->getAssigneeType() === Department::class ?
            $model->departments()->detach($object->getAssigneeId()) :
            $model->users()->detach($object->getAssigneeId());

        return [];

    }
}