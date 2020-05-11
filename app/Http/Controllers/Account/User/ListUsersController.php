<?php

namespace App\Http\Controllers\Account\User;

use App\Classes\Modules\Accounts\ControllerLogic\ListUsersControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListUsersController
{
    /**
     * @param Request $request
     * @param ListUsersControllerLogic $logic
     * @return JsonResponse
     */
    public function list(Request $request, ListUsersControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}