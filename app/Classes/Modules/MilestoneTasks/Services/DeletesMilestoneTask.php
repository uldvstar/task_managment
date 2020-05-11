<?php

namespace App\Classes\Modules\MilestoneTasks\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Models\MilestoneTask;

class DeletesMilestoneTask extends AbstractDeleteRecord
{

    public function execute(MilestoneTask $model) {
        return $this->handler($model);
    }
}