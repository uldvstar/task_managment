<?php

namespace App\Http\Controllers\ModularTypes;

use App\Classes\Modules\ModularTypes\ControllerLogic\DeleteModularTypeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteModularTypeController
{
    /**
     * @param Request $request
     * @param DeleteModularTypeControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteModularTypeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}