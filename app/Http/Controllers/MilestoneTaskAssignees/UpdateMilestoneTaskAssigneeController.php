<?php

namespace App\Http\Controllers\MilestoneTaskAssignees;

use App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic\UpdateMilestoneTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMilestoneTaskAssigneeController
{
    /**
     * @param Request $request
     * @param UpdateMilestoneTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateMilestoneTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}