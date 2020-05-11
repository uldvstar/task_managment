<?php

namespace App\Http\Controllers\Tasks;

use App\Classes\Modules\Tasks\ControllerLogic\ListTasksControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTasksController
{
    /**
     * @param Request $request
     * @param listTasksControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listTasksControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}