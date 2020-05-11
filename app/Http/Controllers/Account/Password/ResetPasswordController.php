<?php

namespace App\Http\Controllers\Account\Password;


use App\Classes\Modules\Accounts\ControllerLogic\ResetPasswordLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordController
{

    /**
     * @param Request $request
     * @param ResetPasswordLogic $logic
     * @return JsonResponse
     */
    public function reset(Request $request, ResetPasswordLogic $logic): jsonResponse {
        return $logic->execute($request);
    }

}