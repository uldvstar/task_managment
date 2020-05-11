<?php

namespace App\Http\Controllers\TaskAssignees;

use App\Classes\Modules\TaskAssignees\ControllersLogic\ListTaskAssigneesControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTaskAssigneesController
{
    /**
     * @param Request $request
     * @param listTaskAssigneesControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listTaskAssigneesControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}