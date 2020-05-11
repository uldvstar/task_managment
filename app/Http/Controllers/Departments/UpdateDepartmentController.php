<?php

namespace App\Http\Controllers\Departments;

use App\Classes\Modules\Departments\ControllerLogic\UpdateDepartmentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateDepartmentController
{
    /**
     * @param Request $request
     * @param UpdateDepartmentControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateDepartmentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}