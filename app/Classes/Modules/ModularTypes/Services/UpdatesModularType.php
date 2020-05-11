<?php

namespace App\Classes\Modules\ModularTypes\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Models\ModularType;

class UpdatesModularType extends AbstractUpdateRecord
{

    public function execute(ModularType $model, ModularTypeObject $object) {

        $model->module_type = $object->getModuleType();
        $model->name = $object->getName();
        $model->reference = $object->getReference();
        $model->description = $object->getDescription();

        return $this->handler($model);

    }
}