<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTaskAssignees\Services\CreatesMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules\CanCreateMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Http\Resources\MilestoneTaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMilestoneTaskAssigneeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Milestone Task Assignee',
            'message' => 'You have successfully created a new Milestone Task Assignee'
        ];
    }

    /** @var CanCreateMilestoneTaskAssignee */
    private $canCreateMilestoneTaskAssignee;

    /** @var CreatesMilestoneTaskAssignee */
    private $createsMilestoneTaskAssignee;

    /**
     * CreateMilestoneTaskAssigneeControllerLogic constructor.
     * @param CanCreateMilestoneTaskAssignee $canCreateMilestoneTaskAssignee
     * @param CreatesMilestoneTaskAssignee $createsMilestoneTaskAssignee
     */
    public function __construct(CanCreateMilestoneTaskAssignee $canCreateMilestoneTaskAssignee, CreatesMilestoneTaskAssignee $createsMilestoneTaskAssignee)
    {
        $this->canCreateMilestoneTaskAssignee = $canCreateMilestoneTaskAssignee;
        $this->createsMilestoneTaskAssignee = $createsMilestoneTaskAssignee;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $object = new MilestoneTaskAssigneeObject($request->input('assignee_id'), $request->input('assignee_type'), $request->input('assignment_id'));

            $this->canCreateMilestoneTaskAssignee->passes($object);

            $query = $this->createsMilestoneTaskAssignee->execute($object);

            return $this->resourceResponse(new MilestoneTaskAssigneeResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}