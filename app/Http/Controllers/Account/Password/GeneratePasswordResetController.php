<?php

namespace App\Http\Controllers\Account\Password;


use App\Classes\Modules\Accounts\ControllerLogic\GeneratePasswordResetLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneratePasswordResetController
{

    /**
     * @param Request $request
     * @param GeneratePasswordResetLogic $logic
     * @return JsonResponse
     */
    public function generate(Request $request, GeneratePasswordResetLogic $logic): jsonResponse {
        return $logic->execute($request);
    }

}