<?php

namespace App\Http\Controllers\MilestoneTasks;

use App\Classes\Modules\MilestoneTasks\ControllerLogic\CreateMilestoneTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMilestoneTaskController
{
    /**
     * @param Request $request
     * @param CreateMilestoneTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateMilestoneTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}