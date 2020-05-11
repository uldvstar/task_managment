<?php

namespace App\Http\Controllers\MilestoneTasks;

use App\Classes\Modules\MilestoneTasks\ControllerLogic\UpdateMilestoneTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMilestoneTaskController
{
    /**
     * @param Request $request
     * @param UpdateMilestoneTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateMilestoneTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}