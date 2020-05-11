<?php

namespace App\Http\Controllers\MilestoneTaskAssignees;

use App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic\CreateMilestoneTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMilestoneTaskAssigneeController
{
    /**
     * @param Request $request
     * @param CreateMilestoneTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateMilestoneTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}