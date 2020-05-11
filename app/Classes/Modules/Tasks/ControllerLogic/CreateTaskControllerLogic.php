<?php

namespace App\Classes\Modules\Tasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Tasks\Services\CreatesTask;
use App\Classes\Modules\Tasks\Standards\Rules\CanCreateTask;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;
use App\Http\Resources\TaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTaskControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Task',
            'message' => 'You have successfully created a new Task'
        ];
    }

    /** @var CanCreateTask */
    private $canCreateTask;

    /** @var CreatesTask */
    private $createsTask;

    /**
     * CreateTaskControllerLogic constructor.
     * @param CanCreateTask $canCreateTask
     * @param CreatesTask $createsTask
     */
    public function __construct(CanCreateTask $canCreateTask, CreatesTask $createsTask)
    {
        $this->canCreateTask = $canCreateTask;
        $this->createsTask = $createsTask;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $object = new TaskObject($request->input('milestone_id'), $request->input('type_id'), $request->input('title'), $request->input('description'), $request->input('status'), $request->input('active'));

            $this->canCreateTask->passes($object);

            $query = $this->createsTask->execute($object);

            return $this->resourceResponse(new TaskResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}