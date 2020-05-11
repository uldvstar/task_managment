<?php

namespace App\Classes\Modules\TaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\TaskAssignees\Services\CreatesTaskAssignee;
use App\Classes\Modules\TaskAssignees\Standards\Rules\CanCreateTaskAssignee;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Http\Resources\TaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTaskAssigneeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Task Assignee',
            'message' => 'You have successfully created a new Task Assignee'
        ];
    }

    /** @var CanCreateTaskAssignee */
    private $canCreateTaskAssignee;

    /** @var CreatesTaskAssignee */
    private $createsTaskAssignee;

    /**
     * CreateTaskAssigneeControllerLogic constructor.
     * @param CanCreateTaskAssignee $canCreateTaskAssignee
     * @param CreatesTaskAssignee $createsTaskAssignee
     */
    public function __construct(CanCreateTaskAssignee $canCreateTaskAssignee, CreatesTaskAssignee $createsTaskAssignee)
    {
        $this->canCreateTaskAssignee = $canCreateTaskAssignee;
        $this->createsTaskAssignee = $createsTaskAssignee;
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

            $this->canCreateTaskAssignee->passes($object);

            $query = $this->createsTaskAssignee->execute($object);

            return $this->resourceResponse(new TaskAssigneeResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}