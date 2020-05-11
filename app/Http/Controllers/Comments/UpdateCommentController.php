<?php

namespace App\Http\Controllers\Comments;

use App\Classes\Modules\Comments\ControllersLogic\UpdateCommentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateCommentController
{
    /**
     * @param Request $request
     * @param UpdateCommentControllerLogic $logic
     * @return JsonResponse
     */
    public function update(Request $request, UpdateCommentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}