<?php

namespace App\Http\Controllers\ModularTypes;

use App\Classes\Modules\ModularTypes\ControllerLogic\ListModularTypesControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListModularTypesController
{
    /**
     * @param Request $request
     * @param listModularTypesControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listModularTypesControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}