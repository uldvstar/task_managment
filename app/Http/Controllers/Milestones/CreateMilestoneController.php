<?php

namespace App\Http\Controllers\Milestones;

use App\Classes\Modules\Milestones\ControllerLogic\CreateMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMilestoneController
{
    /**
     * @param Request $request
     * @param CreateMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}