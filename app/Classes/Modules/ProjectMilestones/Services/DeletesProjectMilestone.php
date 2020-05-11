<?php

namespace App\Classes\Modules\ProjectMilestones\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;
use App\Models\ProjectMilestone;

class DeletesProjectMilestone extends AbstractDeleteRecord
{

    public function execute(ProjectMilestone $model) {
        return $this->handler($model);
    }
}