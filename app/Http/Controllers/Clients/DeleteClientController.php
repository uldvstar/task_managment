<?php

namespace App\Http\Controllers\Clients;

use App\Classes\Modules\Clients\ControllerLogic\DeleteClientControllerLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteClientController
{
    /**
     * @param Request $request
     * @param DeleteClientControllerLogic $logic
     * @return JsonResponse
     */
    public function destroy(Request $request, DeleteClientControllerLogic $logic): JsonResponse {
        return $logic->execute($request);
    }

}