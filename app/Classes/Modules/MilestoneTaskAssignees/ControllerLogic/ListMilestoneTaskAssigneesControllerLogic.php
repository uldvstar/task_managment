<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTaskAssignees\Services\ListsMilestoneTaskAssignees;
use App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules\CanListMilestoneTaskAssignees;
use App\Http\Resources\MilestoneTaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMilestoneTaskAssigneesControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Milestone Task Assignees',
            'message' => 'You have successfully retrieved a list of Milestone Task Assignees'
        ];
    }

    /** @var CanListMilestoneTaskAssignees */
    private $canListMilestoneTaskAssignees;

    /** @var ListsMilestoneTaskAssignees */
    private $listsMilestoneTaskAssignees;

    /**
     * ListMilestoneTaskAssigneesControllerLogic constructor.
     * @param CanListMilestoneTaskAssignees $canListMilestoneTaskAssignees
     * @param ListsMilestoneTaskAssignees $listsMilestoneTaskAssignees
     */
    public function __construct(CanListMilestoneTaskAssignees $canListMilestoneTaskAssignees, ListsMilestoneTaskAssignees $listsMilestoneTaskAssignees)
    {
        $this->canListMilestoneTaskAssignees = $canListMilestoneTaskAssignees;
        $this->listsMilestoneTaskAssignees = $listsMilestoneTaskAssignees;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListMilestoneTaskAssignees->passes();

            $query = $this->listsMilestoneTaskAssignees->execute($this->listsMilestoneTaskAssignees->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(MilestoneTaskAssigneeResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}