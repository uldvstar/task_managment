<?php

namespace App\Http\Controllers\ModularTypes;

use App\Classes\Modules\ModularTypes\ControllerLogic\UpdateModularTypeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateModularTypeController
{
    /**
     * @param Request $request
     * @param UpdateModularTypeControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateModularTypeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}