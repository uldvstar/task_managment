<?php

namespace App\Classes\Modules\Tasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Tasks\Services\ListsTasks;
use App\Classes\Modules\Tasks\Standards\Rules\CanListTasks;
use App\Http\Resources\TaskResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTasksControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Tasks',
            'message' => 'You have successfully retrieved a list of Tasks'
        ];
    }

    /** @var CanListTasks */
    private $canListTasks;

    /** @var ListsTasks */
    private $listsTasks;

    /**
     * ListTasksControllerLogic constructor.
     * @param CanListTasks $canListTasks
     * @param ListsTasks $listsTasks
     */
    public function __construct(CanListTasks $canListTasks, ListsTasks $listsTasks)
    {
        $this->canListTasks = $canListTasks;
        $this->listsTasks = $listsTasks;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListTasks->passes();

            $query = $this->listsTasks->execute($this->listsTasks->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(TaskResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}