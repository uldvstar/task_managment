<?php

namespace App\Classes\Modules\Milestones\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;
use App\Models\Milestone;

class DeletesMilestone extends AbstractDeleteRecord
{

    public function execute(Milestone $model) {
        return $this->handler($model);
    }
}