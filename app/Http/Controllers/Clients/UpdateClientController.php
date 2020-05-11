<?php

namespace App\Http\Controllers\Clients;

use App\Classes\Modules\Clients\ControllerLogic\UpdateClientControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateClientController
{
    /**
     * @param Request $request
     * @param UpdateClientControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateClientControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}