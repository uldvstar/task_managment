<?php

namespace App\Classes\Modules\Tasks\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;
use App\Models\Task;

class UpdatesTask extends AbstractUpdateRecord
{

    public function execute(Task $model, TaskObject $object) {

        $model->milestone_id = $object->getMilestoneId();
        $model->type_id = $object->getTypeId();
        $model->title = $object->getTitle();
        $model->description = $object->getDescription();
        $model->status = $object->getStatus();
        $model->active = $object->isActive();

        return $this->handler($model);

    }
}