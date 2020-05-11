<?php

namespace App\Http\Controllers\Tasks;

use App\Classes\Modules\Tasks\ControllerLogic\FetchTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchTaskController
{
    /**
     * @param Request $request
     * @param FetchTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}