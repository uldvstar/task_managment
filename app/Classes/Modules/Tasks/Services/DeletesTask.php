<?php

namespace App\Classes\Modules\Tasks\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;
use App\Models\Task;

class DeletesTask extends AbstractDeleteRecord
{

    public function execute(Task $model) {
        return $this->handler($model);
    }
}