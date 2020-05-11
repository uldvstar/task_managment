<?php

namespace App\Classes\Modules\TaskAssignees\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Models\Department;
use App\Models\Task;

class DeletesTaskAssignee extends AbstractDeleteRecord
{

    public function execute(TaskAssigneeObject $object) {
        $model = Task::find($object->getAssignmentId());
        $object->getAssigneeType() === Department::class ?
            $model->departments()->detach($object->getAssigneeId()) :
            $model->users()->detach($object->getAssigneeId());

        return [];
    }
}