<?php

namespace App\Http\Controllers\Milestones;

use App\Classes\Modules\Milestones\ControllerLogic\ListMilestonesControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMilestonesController
{
    /**
     * @param Request $request
     * @param listMilestonesControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listMilestonesControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}