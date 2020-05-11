<?php

namespace App\Http\Controllers\Departments;

use App\Classes\Modules\Departments\ControllerLogic\CreateDepartmentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDepartmentController
{
    /**
     * @param Request $request
     * @param CreateDepartmentControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateDepartmentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}