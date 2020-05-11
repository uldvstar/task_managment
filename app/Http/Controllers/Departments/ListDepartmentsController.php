<?php

namespace App\Http\Controllers\Departments;

use App\Classes\Modules\Departments\ControllerLogic\ListDepartmentsControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListDepartmentsController
{
    /**
     * @param Request $request
     * @param listDepartmentsControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listDepartmentsControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}