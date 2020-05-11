<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTaskAssignees\Services\UpdatesMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\Services\FetchesMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules\CanUpdateMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Http\Resources\MilestoneTaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMilestoneTaskAssigneeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Milestone Task Assignee',
            'message' => 'You have successfully updated the Milestone Task Assignee'
        ];
    }

    /** @var CanUpdateMilestoneTaskAssignee */
    private $canUpdateMilestoneTaskAssignee;

    /** @var UpdatesMilestoneTaskAssignee */
    private $updatesMilestoneTaskAssignee;

    /** @var FetchesMilestoneTaskAssignee */
    private $fetchesMilestoneTaskAssignee;

    /**
     * UpdateMilestoneTaskAssigneeControllerLogic constructor.
     * @param CanUpdateMilestoneTaskAssignee $canUpdateMilestoneTaskAssignee
     * @param UpdatesMilestoneTaskAssignee $updatesMilestoneTaskAssignee
     * @param FetchesMilestoneTaskAssignee $fetchesMilestoneTaskAssignee
     */
    public function __construct(CanUpdateMilestoneTaskAssignee $canUpdateMilestoneTaskAssignee, UpdatesMilestoneTaskAssignee $updatesMilestoneTaskAssignee, FetchesMilestoneTaskAssignee $fetchesMilestoneTaskAssignee)
    {
        $this->canUpdateMilestoneTaskAssignee = $canUpdateMilestoneTaskAssignee;
        $this->updatesMilestoneTaskAssignee = $updatesMilestoneTaskAssignee;
        $this->fetchesMilestoneTaskAssignee = $fetchesMilestoneTaskAssignee;
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

            $this->canUpdateMilestoneTaskAssignee->passes($object);

            $query = $this->fetchesMilestoneTaskAssignee->execute(['id' => $request->route('id')]);

            $query = $this->updatesMilestoneTaskAssignee->execute($query, $object);

            return $this->resourceResponse(new MilestoneTaskAssigneeResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}