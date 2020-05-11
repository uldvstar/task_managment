<?php

namespace App\Http\Controllers\Tasks;

use App\Classes\Modules\Tasks\ControllerLogic\CreateTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTaskController
{
    /**
     * @param Request $request
     * @param CreateTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}