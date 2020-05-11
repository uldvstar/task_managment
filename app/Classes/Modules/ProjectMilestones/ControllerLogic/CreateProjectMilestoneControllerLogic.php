<?php

namespace App\Classes\Modules\ProjectMilestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ProjectMilestones\Services\CreatesProjectMilestone;
use App\Classes\Modules\ProjectMilestones\Standards\Rules\CanCreateProjectMilestone;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;
use App\Http\Resources\ProjectMilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateProjectMilestoneControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Project Milestone',
            'message' => 'You have successfully created a new Project Milestone'
        ];
    }

    /** @var CanCreateProjectMilestone */
    private $canCreateProjectMilestone;

    /** @var CreatesProjectMilestone */
    private $createsProjectMilestone;

    /**
     * CreateProjectMilestoneControllerLogic constructor.
     * @param CanCreateProjectMilestone $canCreateProjectMilestone
     * @param CreatesProjectMilestone $createsProjectMilestone
     */
    public function __construct(CanCreateProjectMilestone $canCreateProjectMilestone, CreatesProjectMilestone $createsProjectMilestone)
    {
        $this->canCreateProjectMilestone = $canCreateProjectMilestone;
        $this->createsProjectMilestone = $createsProjectMilestone;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $object = new ProjectMilestoneObject($request->input('project_id'), $request->input('name'), $request->input('order'), $request->input('complete'));

            $this->canCreateProjectMilestone->passes($object);

            $query = $this->createsProjectMilestone->execute($object);

            return $this->resourceResponse(new ProjectMilestoneResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}