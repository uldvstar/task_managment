<?php

namespace App\Http\Controllers\ModularTypes;

use App\Classes\Modules\ModularTypes\ControllerLogic\CreateModularTypeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateModularTypeController
{
    /**
     * @param Request $request
     * @param CreateModularTypeControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateModularTypeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}