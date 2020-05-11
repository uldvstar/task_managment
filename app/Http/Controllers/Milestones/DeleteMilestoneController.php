<?php

namespace App\Http\Controllers\Milestones;

use App\Classes\Modules\Milestones\ControllerLogic\DeleteMilestoneControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMilestoneController
{
    /**
     * @param Request $request
     * @param DeleteMilestoneControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteMilestoneControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}