<?php

namespace App\Http\Controllers\Account\Authentication;

use App\Classes\Modules\Accounts\ControllerLogic\AuthenticateUserLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAuthenticationController
{

    /**
     * @param Request $request
     * @param AuthenticateUserLogic $logic
     * @return JsonResponse
     */
    public function authenticate(Request $request, AuthenticateUserLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}
