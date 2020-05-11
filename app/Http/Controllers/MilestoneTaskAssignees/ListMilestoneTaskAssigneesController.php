<?php

namespace App\Http\Controllers\MilestoneTaskAssignees;

use App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic\ListMilestoneTaskAssigneesControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMilestoneTaskAssigneesController
{
    /**
     * @param Request $request
     * @param listMilestoneTaskAssigneesControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listMilestoneTaskAssigneesControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}