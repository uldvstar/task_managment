<?php

namespace App\Classes\Modules\Projects\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Projects\Services\CreatesProject;
use App\Classes\Modules\Projects\Services\CreatesProjectWorkFlow;
use App\Classes\Modules\Projects\Standards\Rules\CanCreateProject;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Http\Resources\ProjectResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateProjectControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Project',
            'message' => 'You have successfully created a new Project'
        ];
    }

    /** @var CanCreateProject */
    private $canCreateProject;

    /** @var CreatesProject */
    private $createsProject;

    /** @var CreatesProjectWorkFlow */
    private $createsProjectWorkFlow;

    /**
     * CreateProjectControllerLogic constructor.
     * @param CanCreateProject $canCreateProject
     * @param CreatesProject $createsProject
     * @param CreatesProjectWorkFlow $createsProjectWorkFlow
     */
    public function __construct(CanCreateProject $canCreateProject, CreatesProject $createsProject, CreatesProjectWorkFlow $createsProjectWorkFlow)
    {
        $this->canCreateProject = $canCreateProject;
        $this->createsProject = $createsProject;
        $this->createsProjectWorkFlow = $createsProjectWorkFlow;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $object = new ProjectObject($request->input('type_id'), $request->input('client_id'), $request->input('reference'), $request->input('description'), $request->input('status'));

            $this->canCreateProject->passes($object);


            $query = $this->createsProject->execute($object);

            $this->createsProjectWorkFlow->execute($query);

            return $this->resourceResponse(new ProjectResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}