<?php

namespace App\Classes\Modules\MilestoneTasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTasks\Services\FetchesMilestoneTask;
use App\Classes\Modules\MilestoneTasks\Standards\Rules\CanFetchMilestoneTask;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Http\Resources\MilestoneTaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchMilestoneTaskControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Milestone Task',
            'message' => 'You have successfully retrieved a Milestone Task'
        ];
    }

    /** @var CanFetchMilestoneTask */
    private $canFetchMilestoneTask;

    /** @var FetchesMilestoneTask */
    private $fetchesMilestoneTask;

    /**
     * FetchMilestoneTaskControllerLogic constructor.
     * @param CanFetchMilestoneTask $canFetchMilestoneTask
     * @param FetchesMilestoneTask $fetchesMilestoneTask
     */
    public function __construct(CanFetchMilestoneTask $canFetchMilestoneTask, FetchesMilestoneTask $fetchesMilestoneTask)
    {
        $this->canFetchMilestoneTask = $canFetchMilestoneTask;
        $this->fetchesMilestoneTask = $fetchesMilestoneTask;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canFetchMilestoneTask->passes();

            $query = $this->fetchesMilestoneTask->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new MilestoneTaskResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}