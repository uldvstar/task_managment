<?php

namespace App\Classes\Modules\MilestoneTasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\MilestoneTasks\Services\CreatesMilestoneTask;
use App\Classes\Modules\MilestoneTasks\Standards\Rules\CanCreateMilestoneTask;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Http\Resources\MilestoneTaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMilestoneTaskControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Milestone Task',
            'message' => 'You have successfully created a new Milestone Task'
        ];
    }

    /** @var CanCreateMilestoneTask */
    private $canCreateMilestoneTask;

    /** @var CreatesMilestoneTask */
    private $createsMilestoneTask;

    /**
     * CreateMilestoneTaskControllerLogic constructor.
     * @param CanCreateMilestoneTask $canCreateMilestoneTask
     * @param CreatesMilestoneTask $createsMilestoneTask
     */
    public function __construct(CanCreateMilestoneTask $canCreateMilestoneTask, CreatesMilestoneTask $createsMilestoneTask)
    {
        $this->canCreateMilestoneTask = $canCreateMilestoneTask;
        $this->createsMilestoneTask = $createsMilestoneTask;
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

            $this->canCreateMilestoneTask->passes($object);

            $query = $this->createsMilestoneTask->execute($object);

            return $this->resourceResponse(new MilestoneTaskResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}