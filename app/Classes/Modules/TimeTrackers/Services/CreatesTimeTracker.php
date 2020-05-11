<?php

namespace App\Classes\Modules\TimeTrackers\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\TimeTrackers\DataTransferObjects\TimeTrackerObject;
use App\Models\TimeTracker;

class CreatesTimeTracker extends AbstractUpdateRecord
{

    public function execute(TimeTrackerObject $object) {
        $model = new TimeTracker();
        $model->trackable_id = $object->getTrackableId();
        $model->trackable_type = $object->getTrackableType();
        $model->user_id = $object->getUserId();
        $model->time_start = $object->getTimeStart();
        $model->time_end = $object->getTimeEnd();

        return $this->handler($model);

    }
}