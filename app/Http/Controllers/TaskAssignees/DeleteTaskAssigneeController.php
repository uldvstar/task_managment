<?php

namespace App\Http\Controllers\TaskAssignees;

use App\Classes\Modules\TaskAssignees\ControllersLogic\DeleteTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteTaskAssigneeController
{
    /**
     * @param Request $request
     * @param DeleteTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}