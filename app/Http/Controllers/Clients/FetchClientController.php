<?php

namespace App\Http\Controllers\Clients;

use App\Classes\Modules\Clients\ControllerLogic\FetchClientControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchClientController
{
    /**
     * @param Request $request
     * @param FetchClientControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchClientControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}