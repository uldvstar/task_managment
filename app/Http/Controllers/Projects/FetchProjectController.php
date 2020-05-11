<?php

namespace App\Http\Controllers\Projects;

use App\Classes\Modules\Projects\ControllerLogic\FetchProjectControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchProjectController
{
    /**
     * @param Request $request
     * @param FetchProjectControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchProjectControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}