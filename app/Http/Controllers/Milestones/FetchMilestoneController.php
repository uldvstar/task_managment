<?php

namespace App\Http\Controllers\Milestones;

use App\Classes\Modules\Milestones\ControllerLogic\FetchMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchMilestoneController
{
    /**
     * @param Request $request
     * @param FetchMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}