<?php

namespace App\Http\Controllers\MilestoneTaskAssignees;

use App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic\FetchMilestoneTaskAssigneeControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchMilestoneTaskAssigneeController
{
    /**
     * @param Request $request
     * @param FetchMilestoneTaskAssigneeControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchMilestoneTaskAssigneeControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}