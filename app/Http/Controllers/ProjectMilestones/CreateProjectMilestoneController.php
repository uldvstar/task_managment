<?php

namespace App\Http\Controllers\ProjectMilestones;

use App\Classes\Modules\ProjectMilestones\ControllerLogic\CreateProjectMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateProjectMilestoneController
{
    /**
     * @param Request $request
     * @param CreateProjectMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateProjectMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}