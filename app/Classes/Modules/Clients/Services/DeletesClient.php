<?php

namespace App\Classes\Modules\Clients\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;
use App\Models\Client;

class DeletesClient extends AbstractDeleteRecord
{

    public function execute(Client $model) {
        return $this->handler($model);
    }
}