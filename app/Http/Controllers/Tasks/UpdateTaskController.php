<?php

namespace App\Http\Controllers\Tasks;

use App\Classes\Modules\Tasks\ControllerLogic\UpdateTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTaskController
{
    /**
     * @param Request $request
     * @param UpdateTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}