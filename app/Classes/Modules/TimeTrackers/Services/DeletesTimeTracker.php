<?php

namespace App\Classes\Modules\TimeTrackers\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\TimeTrackers\DataTransferObjects\TimeTrackerObject;
use App\Models\TimeTracker;

class DeletesTimeTracker extends AbstractDeleteRecord
{

    public function execute(TimeTracker $model) {
        return $this->handler($model);
    }
}