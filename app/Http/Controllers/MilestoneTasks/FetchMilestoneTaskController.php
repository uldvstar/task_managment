<?php

namespace App\Http\Controllers\MilestoneTasks;

use App\Classes\Modules\MilestoneTasks\ControllerLogic\FetchMilestoneTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchMilestoneTaskController
{
    /**
     * @param Request $request
     * @param FetchMilestoneTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchMilestoneTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}