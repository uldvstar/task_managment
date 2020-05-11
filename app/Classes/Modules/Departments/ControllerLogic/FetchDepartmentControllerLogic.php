<?php

namespace App\Classes\Modules\Departments\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Departments\Services\FetchesDepartment;
use App\Classes\Modules\Departments\Standards\Rules\CanFetchDepartment;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;
use App\Http\Resources\DepartmentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchDepartmentControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Department',
            'message' => 'You have successfully retrieved a Department'
        ];
    }

    /** @var CanFetchDepartment */
    private $canFetchDepartment;

    /** @var FetchesDepartment */
    private $fetchesDepartment;

    /**
     * FetchDepartmentControllerLogic constructor.
     * @param CanFetchDepartment $canFetchDepartment
     * @param FetchesDepartment $fetchesDepartment
     */
    public function __construct(CanFetchDepartment $canFetchDepartment, FetchesDepartment $fetchesDepartment)
    {
        $this->canFetchDepartment = $canFetchDepartment;
        $this->fetchesDepartment = $fetchesDepartment;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canFetchDepartment->passes();

            $query = $this->fetchesDepartment->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new DepartmentResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}