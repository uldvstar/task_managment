<?php

namespace App\Http\Controllers\MilestoneTaskAssignees;

use App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic\DeleteMilestoneTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMilestoneTaskAssigneeController
{
    /**
     * @param Request $request
     * @param DeleteMilestoneTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteMilestoneTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}