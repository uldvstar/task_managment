<?php

namespace App\Http\Controllers\ModularTypes;

use App\Classes\Modules\ModularTypes\ControllerLogic\FetchModularTypeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchModularTypeController
{
    /**
     * @param Request $request
     * @param FetchModularTypeControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchModularTypeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}