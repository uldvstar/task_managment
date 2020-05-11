<?php

namespace App\Classes\Modules\TaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Classes\Modules\TaskAssignees\Services\DeletesTaskAssignee;
use App\Classes\Modules\TaskAssignees\Services\FetchesTaskAssignee;
use App\Classes\Modules\TaskAssignees\Standards\Rules\CanDeleteTaskAssignee;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteTaskAssigneeControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Task Assignee',
            'message' => 'You have successfully deleted a Task Assignee'
        ];
    }


    /** @var CanDeleteTaskAssignee */
    private $canDeleteTaskAssignee;

    /** @var DeletesTaskAssignee */
    private $deletesTaskAssignee;

    /** @var FetchesTaskAssignee */
        private $fetchesTaskAssignee;

    /**
     * DeleteTaskAssigneeControllerLogic constructor.
     * @param CanDeleteTaskAssignee $canDeleteTaskAssignee
     * @param DeletesTaskAssignee $deletesTaskAssignee
     * @param FetchesTaskAssignee $fetchesTaskAssignee
     */
    public function __construct(CanDeleteTaskAssignee $canDeleteTaskAssignee, DeletesTaskAssignee $deletesTaskAssignee, FetchesTaskAssignee $fetchesTaskAssignee)
    {
        $this->canDeleteTaskAssignee = $canDeleteTaskAssignee;
        $this->deletesTaskAssignee = $deletesTaskAssignee;
        $this->fetchesTaskAssignee = $fetchesTaskAssignee;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canDeleteTaskAssignee->passes();

            $object = new TaskAssigneeObject($request->input('assignee_id'), $request->input('assignee_type'), $request->input('assignment_id'));

            $this->deletesTaskAssignee->execute($object);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}