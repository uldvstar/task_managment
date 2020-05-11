<?php

namespace App\Http\Controllers\Clients;

use App\Classes\Modules\Clients\ControllerLogic\ListClientsControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListClientsController
{
    /**
     * @param Request $request
     * @param listClientsControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listClientsControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}