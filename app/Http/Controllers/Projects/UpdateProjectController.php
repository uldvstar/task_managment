<?php

namespace App\Http\Controllers\Projects;

use App\Classes\Modules\Projects\ControllerLogic\UpdateProjectControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateProjectController
{
    /**
     * @param Request $request
     * @param UpdateProjectControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateProjectControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}