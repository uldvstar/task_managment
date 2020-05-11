<?php

namespace App\Classes\Modules\MilestoneTasks\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Models\MilestoneTask;

class CreatesMilestoneTask extends AbstractUpdateRecord
{

    public function execute(MilestoneTaskObject $object) {
        $model = new MilestoneTask();
        $model->milestone_id = $object->getMilestoneId();
        $model->type_id = $object->getTypeId();
        $model->title = $object->getTitle();
        $model->description = $object->getDescription();

        return $this->handler($model);

    }
}