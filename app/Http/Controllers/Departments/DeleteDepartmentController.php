<?php

namespace App\Http\Controllers\Departments;

use App\Classes\Modules\Departments\ControllerLogic\DeleteDepartmentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteDepartmentController
{
    /**
     * @param Request $request
     * @param DeleteDepartmentControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteDepartmentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}