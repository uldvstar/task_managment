<?php

namespace App\Classes\Modules\Departments\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;
use App\Models\Department;

class UpdatesDepartment extends AbstractUpdateRecord
{

    public function execute(Department $model, DepartmentObject $object) {

        $model->name = $object->getName();
        $model->description = $object->getDescription();
        $model->head_id = $object->getHeadId();

        return $this->handler($model);

    }
}