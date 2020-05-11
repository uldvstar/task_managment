<?php

namespace App\Classes\Modules\Projects\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Models\Project;

class CreatesProject extends AbstractUpdateRecord
{

    public function execute(ProjectObject $object) {
        $model = new Project();
        $model->type_id = $object->getTypeId();
        $model->client_id = $object->getClientId();
        $model->reference = $object->getReference();
        $model->description = $object->getDescription();
        $model->status = $object->getStatus();

        return $this->handler($model);

    }
}