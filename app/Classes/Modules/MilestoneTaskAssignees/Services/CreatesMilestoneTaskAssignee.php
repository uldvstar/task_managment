<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Models\Department;
use App\Models\MilestoneTask;
use App\Models\MilestoneTaskAssignee;

class CreatesMilestoneTaskAssignee extends AbstractUpdateRecord
{

    public function execute(MilestoneTaskAssigneeObject $object) {
        $model = MilestoneTask::find($object->getAssignmentId());

        $object->getAssigneeType() === Department::class ?
            $model->departments()->syncWithoutDetaching($object->getAssigneeId()) :
            $model->users()->syncWithoutDetaching($object->getAssigneeId());


        return $this->handler($model);

    }
}