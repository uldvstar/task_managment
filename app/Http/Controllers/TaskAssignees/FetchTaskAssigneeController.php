<?php

namespace App\Http\Controllers\TaskAssignees;

use App\Classes\Modules\TaskAssignees\ControllersLogic\FetchTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchTaskAssigneeController
{
    /**
     * @param Request $request
     * @param FetchTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}