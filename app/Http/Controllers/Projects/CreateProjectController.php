<?php

namespace App\Http\Controllers\Projects;

use App\Classes\Modules\Projects\ControllerLogic\CreateProjectControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateProjectController
{
    /**
     * @param Request $request
     * @param CreateProjectControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateProjectControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}