<?php

namespace App\Http\Controllers\Projects;

use App\Classes\Modules\Projects\ControllerLogic\ListProjectsControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListProjectsController
{
    /**
     * @param Request $request
     * @param listProjectsControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listProjectsControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}