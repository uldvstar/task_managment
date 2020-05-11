<?php

namespace App\Http\Controllers\Comments;

use App\Classes\Modules\Comments\ControllersLogic\ListCommentsControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListCommentsController
{
    /**
     * @param Request $request
     * @param listCommentsControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, listCommentsControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}