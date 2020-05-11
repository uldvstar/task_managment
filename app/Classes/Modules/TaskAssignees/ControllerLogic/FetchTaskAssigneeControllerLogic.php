<?php

namespace App\Classes\Modules\TaskAssignees\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\TaskAssignees\Services\FetchesTaskAssignee;
use App\Classes\Modules\TaskAssignees\Standards\Rules\CanFetchTaskAssignee;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Http\Resources\TaskAssigneeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchTaskAssigneeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Task Assignee',
            'message' => 'You have successfully retrieved a Task Assignee'
        ];
    }

    /** @var CanFetchTaskAssignee */
    private $canFetchTaskAssignee;

    /** @var FetchesTaskAssignee */
    private $fetchesTaskAssignee;

    /**
     * FetchTaskAssigneeControllerLogic constructor.
     * @param CanFetchTaskAssignee $canFetchTaskAssignee
     * @param FetchesTaskAssignee $fetchesTaskAssignee
     */
    public function __construct(CanFetchTaskAssignee $canFetchTaskAssignee, FetchesTaskAssignee $fetchesTaskAssignee)
    {
        $this->canFetchTaskAssignee = $canFetchTaskAssignee;
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

            $this->canFetchTaskAssignee->passes();

            $query = $this->fetchesTaskAssignee->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new TaskAssigneeResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}