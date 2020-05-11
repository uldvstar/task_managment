<?php

namespace App\Classes\Modules\Departments\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Departments\Services\DeletesDepartment;
use App\Classes\Modules\Departments\Services\FetchesDepartment;
use App\Classes\Modules\Departments\Standards\Rules\CanDeleteDepartment;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteDepartmentControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Department',
            'message' => 'You have successfully deleted a Department'
        ];
    }


    /** @var CanDeleteDepartment */
    private $canDeleteDepartment;

    /** @var DeletesDepartment */
    private $deletesDepartment;

    /** @var FetchesDepartment */
        private $fetchesDepartment;

    /**
     * DeleteDepartmentControllerLogic constructor.
     * @param CanDeleteDepartment $canDeleteDepartment
     * @param DeletesDepartment $deletesDepartment
     * @param FetchesDepartment $fetchesDepartment
     */
    public function __construct(CanDeleteDepartment $canDeleteDepartment, DeletesDepartment $deletesDepartment, FetchesDepartment $fetchesDepartment)
    {
        $this->canDeleteDepartment = $canDeleteDepartment;
        $this->deletesDepartment = $deletesDepartment;
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

            $this->canDeleteDepartment->passes();

            $query = $this->fetchesDepartment->execute(['id' => $request->route('id')]);

            $this->deletesDepartment->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}