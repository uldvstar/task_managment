<?php

namespace App\Http\Controllers\Comments;

use App\Classes\Modules\Comments\ControllersLogic\FetchCommentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchCommentController
{
    /**
     * @param Request $request
     * @param FetchCommentControllerLogic $logic
     * @return JsonResponse
     */
    public function fetch(Request $request, FetchCommentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}