<?php

namespace App\Classes\Modules\Departments\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Departments\Services\ListsDepartments;
use App\Classes\Modules\Departments\Standards\Rules\CanListDepartments;
use App\Http\Resources\DepartmentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListDepartmentsControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Departments',
            'message' => 'You have successfully retrieved a list of Departments'
        ];
    }

    /** @var CanListDepartments */
    private $canListDepartments;

    /** @var ListsDepartments */
    private $listsDepartments;

    /**
     * ListDepartmentsControllerLogic constructor.
     * @param CanListDepartments $canListDepartments
     * @param ListsDepartments $listsDepartments
     */
    public function __construct(CanListDepartments $canListDepartments, ListsDepartments $listsDepartments)
    {
        $this->canListDepartments = $canListDepartments;
        $this->listsDepartments = $listsDepartments;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListDepartments->passes();

            $query = $this->listsDepartments->execute($this->listsDepartments->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(DepartmentResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}