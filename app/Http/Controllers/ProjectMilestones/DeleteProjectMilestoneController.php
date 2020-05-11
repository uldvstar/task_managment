<?php

namespace App\Http\Controllers\ProjectMilestones;

use App\Classes\Modules\ProjectMilestones\ControllerLogic\DeleteProjectMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteProjectMilestoneController
{
    /**
     * @param Request $request
     * @param DeleteProjectMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteProjectMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}