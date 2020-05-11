<?php

namespace App\Classes\Modules\Departments\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Departments\Services\CreatesDepartment;
use App\Classes\Modules\Departments\Standards\Rules\CanCreateDepartment;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;
use App\Http\Resources\DepartmentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDepartmentControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Department',
            'message' => 'You have successfully created a new Department'
        ];
    }

    /** @var CanCreateDepartment */
    private $canCreateDepartment;

    /** @var CreatesDepartment */
    private $createsDepartment;

    /**
     * CreateDepartmentControllerLogic constructor.
     * @param CanCreateDepartment $canCreateDepartment
     * @param CreatesDepartment $createsDepartment
     */
    public function __construct(CanCreateDepartment $canCreateDepartment, CreatesDepartment $createsDepartment)
    {
        $this->canCreateDepartment = $canCreateDepartment;
        $this->createsDepartment = $createsDepartment;
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

            $this->canCreateDepartment->passes($object);

            $query = $this->createsDepartment->execute($object);

            return $this->resourceResponse(new DepartmentResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}