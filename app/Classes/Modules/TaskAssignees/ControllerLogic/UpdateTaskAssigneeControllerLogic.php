<?php

namespace App\Classes\Modules\TaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\TaskAssignees\Services\UpdatesTaskAssignee;
use App\Classes\Modules\TaskAssignees\Services\FetchesTaskAssignee;
use App\Classes\Modules\TaskAssignees\Standards\Rules\CanUpdateTaskAssignee;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Http\Resources\TaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTaskAssigneeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Task Assignee',
            'message' => 'You have successfully updated the Task Assignee'
        ];
    }

    /** @var CanUpdateTaskAssignee */
    private $canUpdateTaskAssignee;

    /** @var UpdatesTaskAssignee */
    private $updatesTaskAssignee;

    /** @var FetchesTaskAssignee */
    private $fetchesTaskAssignee;

    /**
     * UpdateTaskAssigneeControllerLogic constructor.
     * @param CanUpdateTaskAssignee $canUpdateTaskAssignee
     * @param UpdatesTaskAssignee $updatesTaskAssignee
     * @param FetchesTaskAssignee $fetchesTaskAssignee
     */
    public function __construct(CanUpdateTaskAssignee $canUpdateTaskAssignee, UpdatesTaskAssignee $updatesTaskAssignee, FetchesTaskAssignee $fetchesTaskAssignee)
    {
        $this->canUpdateTaskAssignee = $canUpdateTaskAssignee;
        $this->updatesTaskAssignee = $updatesTaskAssignee;
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

            $object = new TaskAssigneeObject($request->input('assignee_id'), $request->input('assignee_type'), $request->input('assignment_id'));

            $this->canUpdateTaskAssignee->passes($object);

            $query = $this->fetchesTaskAssignee->execute(['id' => $request->route('id')]);

            $query = $this->updatesTaskAssignee->execute($query, $object);

            return $this->resourceResponse(new TaskAssigneeResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}