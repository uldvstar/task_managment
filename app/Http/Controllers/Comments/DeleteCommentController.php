<?php

namespace App\Http\Controllers\Comments;

use App\Classes\Modules\Comments\ControllersLogic\DeleteCommentControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteCommentController
{
    /**
     * @param Request $request
     * @param DeleteCommentControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteCommentControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}