<?php

namespace App\Classes\Modules\Tasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Tasks\Services\UpdatesTask;
use App\Classes\Modules\Tasks\Services\FetchesTask;
use App\Classes\Modules\Tasks\Standards\Rules\CanUpdateTask;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;
use App\Http\Resources\TaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTaskControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Task',
            'message' => 'You have successfully updated the Task'
        ];
    }

    /** @var CanUpdateTask */
    private $canUpdateTask;

    /** @var UpdatesTask */
    private $updatesTask;

    /** @var FetchesTask */
    private $fetchesTask;

    /**
     * UpdateTaskControllerLogic constructor.
     * @param CanUpdateTask $canUpdateTask
     * @param UpdatesTask $updatesTask
     * @param FetchesTask $fetchesTask
     */
    public function __construct(CanUpdateTask $canUpdateTask, UpdatesTask $updatesTask, FetchesTask $fetchesTask)
    {
        $this->canUpdateTask = $canUpdateTask;
        $this->updatesTask = $updatesTask;
        $this->fetchesTask = $fetchesTask;
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

            $this->canUpdateTask->passes($object);

            $query = $this->fetchesTask->execute(['id' => $request->route('id')]);

            $query = $this->updatesTask->execute($query, $object);

            return $this->resourceResponse(new TaskResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}