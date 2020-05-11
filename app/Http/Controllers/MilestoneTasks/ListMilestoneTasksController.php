<?php

namespace App\Http\Controllers\MilestoneTasks;

use App\Classes\Modules\MilestoneTasks\ControllerLogic\ListMilestoneTasksControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMilestoneTasksController
{
    /**
     * @param Request $request
     * @param listMilestoneTasksControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listMilestoneTasksControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}