<?php

namespace App\Http\Controllers\Projects;

use App\Classes\Modules\Projects\ControllerLogic\DeleteProjectControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteProjectController
{
    /**
     * @param Request $request
     * @param DeleteProjectControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteProjectControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}