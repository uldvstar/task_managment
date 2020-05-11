<?php

namespace App\Http\Controllers\Comments;

use App\Classes\Modules\Comments\ControllersLogic\CreateCommentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateCommentController
{
    /**
     * @param Request $request
     * @param CreateCommentControllerLogic $logic
     * @return JsonResponse
     */
    public function create(Request $request, CreateCommentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}