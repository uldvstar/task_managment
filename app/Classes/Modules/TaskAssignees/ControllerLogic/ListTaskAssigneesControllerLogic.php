<?php

namespace App\Classes\Modules\TaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\TaskAssignees\Services\ListsTaskAssignees;
use App\Classes\Modules\TaskAssignees\Standards\Rules\CanListTaskAssignees;
use App\Http\Resources\TaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTaskAssigneesControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Task Assignees',
            'message' => 'You have successfully retrieved a list of Task Assignees'
        ];
    }

    /** @var CanListTaskAssignees */
    private $canListTaskAssignees;

    /** @var ListsTaskAssignees */
    private $listsTaskAssignees;

    /**
     * ListTaskAssigneesControllerLogic constructor.
     * @param CanListTaskAssignees $canListTaskAssignees
     * @param ListsTaskAssignees $listsTaskAssignees
     */
    public function __construct(CanListTaskAssignees $canListTaskAssignees, ListsTaskAssignees $listsTaskAssignees)
    {
        $this->canListTaskAssignees = $canListTaskAssignees;
        $this->listsTaskAssignees = $listsTaskAssignees;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListTaskAssignees->passes();

            $query = $this->listsTaskAssignees->execute($this->listsTaskAssignees->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(TaskAssigneeResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}