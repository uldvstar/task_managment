<?php

namespace App\Classes\Modules\Departments\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Departments\Services\UpdatesDepartment;
use App\Classes\Modules\Departments\Services\FetchesDepartment;
use App\Classes\Modules\Departments\Standards\Rules\CanUpdateDepartment;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;
use App\Http\Resources\DepartmentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateDepartmentControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Department',
            'message' => 'You have successfully updated the Department'
        ];
    }

    /** @var CanUpdateDepartment */
    private $canUpdateDepartment;

    /** @var UpdatesDepartment */
    private $updatesDepartment;

    /** @var FetchesDepartment */
    private $fetchesDepartment;

    /**
     * UpdateDepartmentControllerLogic constructor.
     * @param CanUpdateDepartment $canUpdateDepartment
     * @param UpdatesDepartment $updatesDepartment
     * @param FetchesDepartment $fetchesDepartment
     */
    public function __construct(CanUpdateDepartment $canUpdateDepartment, UpdatesDepartment $updatesDepartment, FetchesDepartment $fetchesDepartment)
    {
        $this->canUpdateDepartment = $canUpdateDepartment;
        $this->updatesDepartment = $updatesDepartment;
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

            $object = new DepartmentObject($request->input('name'), $request->input('description'), $request->input('head_id'));

            $this->canUpdateDepartment->passes($object);

            $query = $this->fetchesDepartment->execute(['id' => $request->route('id')]);

            $query = $this->updatesDepartment->execute($query, $object);

            return $this->resourceResponse(new DepartmentResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}