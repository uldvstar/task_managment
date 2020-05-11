<?php

namespace App\Classes\Modules\Tasks\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Tasks\Services\DeletesTask;
use App\Classes\Modules\Tasks\Services\FetchesTask;
use App\Classes\Modules\Tasks\Standards\Rules\CanDeleteTask;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteTaskControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Task',
            'message' => 'You have successfully deleted a Task'
        ];
    }


    /** @var CanDeleteTask */
    private $canDeleteTask;

    /** @var DeletesTask */
    private $deletesTask;

    /** @var FetchesTask */
        private $fetchesTask;

    /**
     * DeleteTaskControllerLogic constructor.
     * @param CanDeleteTask $canDeleteTask
     * @param DeletesTask $deletesTask
     * @param FetchesTask $fetchesTask
     */
    public function __construct(CanDeleteTask $canDeleteTask, DeletesTask $deletesTask, FetchesTask $fetchesTask)
    {
        $this->canDeleteTask = $canDeleteTask;
        $this->deletesTask = $deletesTask;
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

            $this->canDeleteTask->passes();

            $query = $this->fetchesTask->execute(['id' => $request->route('id')]);

            $this->deletesTask->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}