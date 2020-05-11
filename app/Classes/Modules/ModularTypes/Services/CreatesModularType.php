<?php

namespace App\Classes\Modules\ModularTypes\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Models\ModularType;

class CreatesModularType extends AbstractUpdateRecord
{

    public function execute(ModularTypeObject $object) {
        $model = new ModularType();
        $model->module_type = $object->getModuleType();
        $model->name = $object->getName();
        $model->reference = $object->getReference();
        $model->description = $object->getDescription();

        return $this->handler($model);

    }
}