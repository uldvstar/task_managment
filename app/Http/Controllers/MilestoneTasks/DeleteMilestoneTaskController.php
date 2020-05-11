<?php

namespace App\Http\Controllers\MilestoneTasks;

use App\Classes\Modules\MilestoneTasks\ControllerLogic\DeleteMilestoneTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMilestoneTaskController
{
    /**
     * @param Request $request
     * @param DeleteMilestoneTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteMilestoneTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}