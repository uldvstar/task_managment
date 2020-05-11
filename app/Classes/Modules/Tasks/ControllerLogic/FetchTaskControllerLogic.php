<?php

namespace App\Classes\Modules\Tasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Tasks\Services\FetchesTask;
use App\Classes\Modules\Tasks\Standards\Rules\CanFetchTask;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;
use App\Http\Resources\TaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchTaskControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Task',
            'message' => 'You have successfully retrieved a Task'
        ];
    }

    /** @var CanFetchTask */
    private $canFetchTask;

    /** @var FetchesTask */
    private $fetchesTask;

    /**
     * FetchTaskControllerLogic constructor.
     * @param CanFetchTask $canFetchTask
     * @param FetchesTask $fetchesTask
     */
    public function __construct(CanFetchTask $canFetchTask, FetchesTask $fetchesTask)
    {
        $this->canFetchTask = $canFetchTask;
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

            $this->canFetchTask->passes();

            $query = $this->fetchesTask->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new TaskResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}