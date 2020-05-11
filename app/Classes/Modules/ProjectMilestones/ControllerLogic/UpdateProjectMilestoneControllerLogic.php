<?php

namespace App\Classes\Modules\ProjectMilestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ProjectMilestones\Services\UpdatesProjectMilestone;
use App\Classes\Modules\ProjectMilestones\Services\FetchesProjectMilestone;
use App\Classes\Modules\ProjectMilestones\Standards\Rules\CanUpdateProjectMilestone;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;
use App\Http\Resources\ProjectMilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateProjectMilestoneControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Project Milestone',
            'message' => 'You have successfully updated the Project Milestone'
        ];
    }

    /** @var CanUpdateProjectMilestone */
    private $canUpdateProjectMilestone;

    /** @var UpdatesProjectMilestone */
    private $updatesProjectMilestone;

    /** @var FetchesProjectMilestone */
    private $fetchesProjectMilestone;

    /**
     * UpdateProjectMilestoneControllerLogic constructor.
     * @param CanUpdateProjectMilestone $canUpdateProjectMilestone
     * @param UpdatesProjectMilestone $updatesProjectMilestone
     * @param FetchesProjectMilestone $fetchesProjectMilestone
     */
    public function __construct(CanUpdateProjectMilestone $canUpdateProjectMilestone, UpdatesProjectMilestone $updatesProjectMilestone, FetchesProjectMilestone $fetchesProjectMilestone)
    {
        $this->canUpdateProjectMilestone = $canUpdateProjectMilestone;
        $this->updatesProjectMilestone = $updatesProjectMilestone;
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

            $object = new ProjectMilestoneObject($request->input('project_id'), $request->input('name'), $request->input('order'), $request->input('complete'));

            $this->canUpdateProjectMilestone->passes($object);

            $query = $this->fetchesProjectMilestone->execute(['id' => $request->route('id')]);

            $query = $this->updatesProjectMilestone->execute($query, $object);

            return $this->resourceResponse(new ProjectMilestoneResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}