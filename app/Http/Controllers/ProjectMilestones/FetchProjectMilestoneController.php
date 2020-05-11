<?php

namespace App\Http\Controllers\ProjectMilestones;

use App\Classes\Modules\ProjectMilestones\ControllerLogic\FetchProjectMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchProjectMilestoneController
{
    /**
     * @param Request $request
     * @param FetchProjectMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchProjectMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}