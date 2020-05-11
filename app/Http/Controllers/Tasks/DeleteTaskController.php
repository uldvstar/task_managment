<?php

namespace App\Http\Controllers\Tasks;

use App\Classes\Modules\Tasks\ControllerLogic\DeleteTaskControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteTaskController
{
    /**
     * @param Request $request
     * @param DeleteTaskControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteTaskControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}