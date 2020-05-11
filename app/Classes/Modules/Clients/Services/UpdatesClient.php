<?php

namespace App\Classes\Modules\Clients\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;
use App\Models\Client;

class UpdatesClient extends AbstractUpdateRecord
{

    public function execute(Client $model, ClientObject $object) {

        $model->type_id = $object->getTypeId();
        $model->marking = $object->getMarking();
        $model->name = $object->getName();
        $model->email = $object->getEmail();
        $model->wechat_id = $object->getWechatId();

        return $this->handler($model);

    }
}