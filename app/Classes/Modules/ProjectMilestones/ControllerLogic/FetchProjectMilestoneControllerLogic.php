<?php

namespace App\Classes\Modules\ProjectMilestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ProjectMilestones\Services\FetchesProjectMilestone;
use App\Classes\Modules\ProjectMilestones\Standards\Rules\CanFetchProjectMilestone;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;
use App\Http\Resources\ProjectMilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchProjectMilestoneControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Project Milestone',
            'message' => 'You have successfully retrieved a Project Milestone'
        ];
    }

    /** @var CanFetchProjectMilestone */
    private $canFetchProjectMilestone;

    /** @var FetchesProjectMilestone */
    private $fetchesProjectMilestone;

    /**
     * FetchProjectMilestoneControllerLogic constructor.
     * @param CanFetchProjectMilestone $canFetchProjectMilestone
     * @param FetchesProjectMilestone $fetchesProjectMilestone
     */
    public function __construct(CanFetchProjectMilestone $canFetchProjectMilestone, FetchesProjectMilestone $fetchesProjectMilestone)
    {
        $this->canFetchProjectMilestone = $canFetchProjectMilestone;
        $this->fetchesProjectMilestone = $fetchesProjectMilestone;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canFetchProjectMilestone->passes();

            $query = $this->fetchesProjectMilestone->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new ProjectMilestoneResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}