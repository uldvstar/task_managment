<?php

namespace App\Classes\Modules\Departments\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;
use App\Models\Department;

class DeletesDepartment extends AbstractDeleteRecord
{

    public function execute(Department $model) {
        return $this->handler($model);
    }
}