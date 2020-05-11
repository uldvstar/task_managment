<?php

namespace App\Http\Controllers\ProjectMilestones;

use App\Classes\Modules\ProjectMilestones\ControllerLogic\ListProjectMilestonesControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListProjectMilestonesController
{
    /**
     * @param Request $request
     * @param listProjectMilestonesControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listProjectMilestonesControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}