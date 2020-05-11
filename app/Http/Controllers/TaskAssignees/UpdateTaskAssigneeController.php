<?php

namespace App\Http\Controllers\TaskAssignees;

use App\Classes\Modules\TaskAssignees\ControllersLogic\UpdateTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTaskAssigneeController
{
    /**
     * @param Request $request
     * @param UpdateTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}