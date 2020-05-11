<?php

namespace App\Classes\Modules\MilestoneTasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTasks\Services\DeletesMilestoneTask;
use App\Classes\Modules\MilestoneTasks\Services\FetchesMilestoneTask;
use App\Classes\Modules\MilestoneTasks\Standards\Rules\CanDeleteMilestoneTask;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMilestoneTaskControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Milestone Task',
            'message' => 'You have successfully deleted a Milestone Task'
        ];
    }


    /** @var CanDeleteMilestoneTask */
    private $canDeleteMilestoneTask;

    /** @var DeletesMilestoneTask */
    private $deletesMilestoneTask;

    /** @var FetchesMilestoneTask */
        private $fetchesMilestoneTask;

    /**
     * DeleteMilestoneTaskControllerLogic constructor.
     * @param CanDeleteMilestoneTask $canDeleteMilestoneTask
     * @param DeletesMilestoneTask $deletesMilestoneTask
     * @param FetchesMilestoneTask $fetchesMilestoneTask
     */
    public function __construct(CanDeleteMilestoneTask $canDeleteMilestoneTask, DeletesMilestoneTask $deletesMilestoneTask, FetchesMilestoneTask $fetchesMilestoneTask)
    {
        $this->canDeleteMilestoneTask = $canDeleteMilestoneTask;
        $this->deletesMilestoneTask = $deletesMilestoneTask;
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

            $this->canDeleteMilestoneTask->passes();

            $query = $this->fetchesMilestoneTask->execute(['id' => $request->route('id')]);

            $this->deletesMilestoneTask->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}