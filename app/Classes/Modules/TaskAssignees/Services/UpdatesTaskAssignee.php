<?php

namespace App\Classes\Modules\TaskAssignees\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Models\TaskAssignee;

class UpdatesTaskAssignee extends AbstractUpdateRecord
{

    public function execute(TaskAssignee $model, TaskAssigneeObject $object) {

        $model->assignee_id = $object->getAssigneeId();
        $model->assignee_type = $object->getAssigneeType();
        $model->assignment_id = $object->getAssignmentId();

        return $this->handler($model);

    }
}