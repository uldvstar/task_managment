<?php

namespace App\Http\Controllers\TaskAssignees;

use App\Classes\Modules\TaskAssignees\ControllersLogic\CreateTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTaskAssigneeController
{
    /**
     * @param Request $request
     * @param CreateTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}