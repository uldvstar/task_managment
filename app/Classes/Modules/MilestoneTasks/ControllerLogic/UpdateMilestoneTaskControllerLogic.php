<?php

namespace App\Classes\Modules\MilestoneTasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTasks\Services\UpdatesMilestoneTask;
use App\Classes\Modules\MilestoneTasks\Services\FetchesMilestoneTask;
use App\Classes\Modules\MilestoneTasks\Standards\Rules\CanUpdateMilestoneTask;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Http\Resources\MilestoneTaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMilestoneTaskControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Milestone Task',
            'message' => 'You have successfully updated the Milestone Task'
        ];
    }

    /** @var CanUpdateMilestoneTask */
    private $canUpdateMilestoneTask;

    /** @var UpdatesMilestoneTask */
    private $updatesMilestoneTask;

    /** @var FetchesMilestoneTask */
    private $fetchesMilestoneTask;

    /**
     * UpdateMilestoneTaskControllerLogic constructor.
     * @param CanUpdateMilestoneTask $canUpdateMilestoneTask
     * @param UpdatesMilestoneTask $updatesMilestoneTask
     * @param FetchesMilestoneTask $fetchesMilestoneTask
     */
    public function __construct(CanUpdateMilestoneTask $canUpdateMilestoneTask, UpdatesMilestoneTask $updatesMilestoneTask, FetchesMilestoneTask $fetchesMilestoneTask)
    {
        $this->canUpdateMilestoneTask = $canUpdateMilestoneTask;
        $this->updatesMilestoneTask = $updatesMilestoneTask;
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

            $object = new MilestoneTaskObject($request->input('milestone_id'), $request->input('type_id'), $request->input('title'), $request->input('description'));

            $this->canUpdateMilestoneTask->passes($object);

            $query = $this->fetchesMilestoneTask->execute(['id' => $request->route('id')]);

            $query = $this->updatesMilestoneTask->execute($query, $object);

            return $this->resourceResponse(new MilestoneTaskResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}