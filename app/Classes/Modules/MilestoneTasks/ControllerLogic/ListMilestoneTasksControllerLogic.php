<?php

namespace App\Classes\Modules\MilestoneTasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTasks\Services\ListsMilestoneTasks;
use App\Classes\Modules\MilestoneTasks\Standards\Rules\CanListMilestoneTasks;
use App\Http\Resources\MilestoneTaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMilestoneTasksControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Milestone Tasks',
            'message' => 'You have successfully retrieved a list of Milestone Tasks'
        ];
    }

    /** @var CanListMilestoneTasks */
    private $canListMilestoneTasks;

    /** @var ListsMilestoneTasks */
    private $listsMilestoneTasks;

    /**
     * ListMilestoneTasksControllerLogic constructor.
     * @param CanListMilestoneTasks $canListMilestoneTasks
     * @param ListsMilestoneTasks $listsMilestoneTasks
     */
    public function __construct(CanListMilestoneTasks $canListMilestoneTasks, ListsMilestoneTasks $listsMilestoneTasks)
    {
        $this->canListMilestoneTasks = $canListMilestoneTasks;
        $this->listsMilestoneTasks = $listsMilestoneTasks;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListMilestoneTasks->passes();

            $query = $this->listsMilestoneTasks->execute(array_merge($this->listsMilestoneTasks->deserializeFilters($request->input('filters')), ['milestone' =>  $request->route('milestone_id')]));

            return $this->collectionResponse(MilestoneTaskResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}