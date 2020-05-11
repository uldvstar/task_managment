<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTaskAssignees\Services\FetchesMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules\CanFetchMilestoneTaskAssignee;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Http\Resources\MilestoneTaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchMilestoneTaskAssigneeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Milestone Task Assignee',
            'message' => 'You have successfully retrieved a Milestone Task Assignee'
        ];
    }

    /** @var CanFetchMilestoneTaskAssignee */
    private $canFetchMilestoneTaskAssignee;

    /** @var FetchesMilestoneTaskAssignee */
    private $fetchesMilestoneTaskAssignee;

    /**
     * FetchMilestoneTaskAssigneeControllerLogic constructor.
     * @param CanFetchMilestoneTaskAssignee $canFetchMilestoneTaskAssignee
     * @param FetchesMilestoneTaskAssignee $fetchesMilestoneTaskAssignee
     */
    public function __construct(CanFetchMilestoneTaskAssignee $canFetchMilestoneTaskAssignee, FetchesMilestoneTaskAssignee $fetchesMilestoneTaskAssignee)
    {
        $this->canFetchMilestoneTaskAssignee = $canFetchMilestoneTaskAssignee;
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

            $this->canFetchMilestoneTaskAssignee->passes();

            $query = $this->fetchesMilestoneTaskAssignee->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new MilestoneTaskAssigneeResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}