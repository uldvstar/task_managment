<?php

namespace App\Http\Controllers\Clients;

use App\Classes\Modules\Clients\ControllerLogic\CreateClientControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateClientController
{
    /**
     * @param Request $request
     * @param CreateClientControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateClientControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}