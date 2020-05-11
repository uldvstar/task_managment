<?php

namespace App\Classes\Modules\Projects\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Models\Project;

class DeletesProject extends AbstractDeleteRecord
{

    public function execute(Project $model) {
        return $this->handler($model);
    }
}