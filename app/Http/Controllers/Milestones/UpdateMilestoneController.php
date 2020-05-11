<?php

namespace App\Http\Controllers\Milestones;

use App\Classes\Modules\Milestones\ControllerLogic\UpdateMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMilestoneController
{
    /**
     * @param Request $request
     * @param UpdateMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}