<?php

namespace App\Http\Controllers\ProjectMilestones;

use App\Classes\Modules\ProjectMilestones\ControllerLogic\UpdateProjectMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateProjectMilestoneController
{
    /**
     * @param Request $request
     * @param UpdateProjectMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateProjectMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}