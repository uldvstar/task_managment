<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Classes\Modules\MilestoneTaskAssignees\Services\DeletesMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\Services\FetchesMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules\CanDeleteMilestoneTaskAssignee;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMilestoneTaskAssigneeControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Milestone Task Assignee',
            'message' => 'You have successfully deleted a Milestone Task Assignee'
        ];
    }


    /** @var CanDeleteMilestoneTaskAssignee */
    private $canDeleteMilestoneTaskAssignee;

    /** @var DeletesMilestoneTaskAssignee */
    private $deletesMilestoneTaskAssignee;

    /** @var FetchesMilestoneTaskAssignee */
        private $fetchesMilestoneTaskAssignee;

    /**
     * DeleteMilestoneTaskAssigneeControllerLogic constructor.
     * @param CanDeleteMilestoneTaskAssignee $canDeleteMilestoneTaskAssignee
     * @param DeletesMilestoneTaskAssignee $deletesMilestoneTaskAssignee
     * @param FetchesMilestoneTaskAssignee $fetchesMilestoneTaskAssignee
     */
    public function __construct(CanDeleteMilestoneTaskAssignee $canDeleteMilestoneTaskAssignee, DeletesMilestoneTaskAssignee $deletesMilestoneTaskAssignee, FetchesMilestoneTaskAssignee $fetchesMilestoneTaskAssignee)
    {
        $this->canDeleteMilestoneTaskAssignee = $canDeleteMilestoneTaskAssignee;
        $this->deletesMilestoneTaskAssignee = $deletesMilestoneTaskAssignee;
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

            $this->canDeleteMilestoneTaskAssignee->passes();
            $object = new MilestoneTaskAssigneeObject($request->input('assignee_id'), $request->input('assignee_type'), $request->input('assignment_id'));

            $this->deletesMilestoneTaskAssignee->execute($object);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}