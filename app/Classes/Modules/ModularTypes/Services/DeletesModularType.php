<?php

namespace App\Classes\Modules\ModularTypes\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Models\ModularType;

class DeletesModularType extends AbstractDeleteRecord
{

    public function execute(ModularType $model) {
        return $this->handler($model);
    }
}