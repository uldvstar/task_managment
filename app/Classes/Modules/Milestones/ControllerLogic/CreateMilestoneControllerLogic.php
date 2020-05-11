<?php

namespace App\Classes\Modules\Milestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Milestones\Services\CreatesMilestone;
use App\Classes\Modules\Milestones\Standards\Rules\CanCreateMilestone;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;
use App\Http\Resources\MilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMilestoneControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Milestone',
            'message' => 'You have successfully created a new Milestone'
        ];
    }

    /** @var CanCreateMilestone */
    private $canCreateMilestone;

    /** @var CreatesMilestone */
    private $createsMilestone;

    /**
     * CreateMilestoneControllerLogic constructor.
     * @param CanCreateMilestone $canCreateMilestone
     * @param CreatesMilestone $createsMilestone
     */
    public function __construct(CanCreateMilestone $canCreateMilestone, CreatesMilestone $createsMilestone)
    {
        $this->canCreateMilestone = $canCreateMilestone;
        $this->createsMilestone = $createsMilestone;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $object = new MilestoneObject($request->input('project_type'), $request->input('name'));

            $this->canCreateMilestone->passes($object);

            $query = $this->createsMilestone->execute($object);

            return $this->resourceResponse(new MilestoneResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}