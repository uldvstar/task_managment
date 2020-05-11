<?php

namespace App\Http\Controllers\Departments;

use App\Classes\Modules\Departments\ControllerLogic\FetchDepartmentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchDepartmentController
{
    /**
     * @param Request $request
     * @param FetchDepartmentControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchDepartmentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}