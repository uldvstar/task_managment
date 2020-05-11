<?php

namespace App\Classes\Modules\MilestoneTasks\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Models\MilestoneTask;

class UpdatesMilestoneTask extends AbstractUpdateRecord
{

    public function execute(MilestoneTask $model, MilestoneTaskObject $object) {

        $model->milestone_id = $object->getMilestoneId();
        $model->type_id = $object->getTypeId();
        $model->title = $object->getTitle();
        $model->description = $object->getDescription();

        return $this->handler($model);

    }
}