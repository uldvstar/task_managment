<?php

namespace App\Classes\Modules\ProjectMilestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ProjectMilestones\Services\ListsProjectMilestones;
use App\Classes\Modules\ProjectMilestones\Standards\Rules\CanListProjectMilestones;
use App\Http\Resources\ProjectMilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListProjectMilestonesControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Project Milestones',
            'message' => 'You have successfully retrieved a list of Project Milestones'
        ];
    }

    /** @var CanListProjectMilestones */
    private $canListProjectMilestones;

    /** @var ListsProjectMilestones */
    private $listsProjectMilestones;

    /**
     * ListProjectMilestonesControllerLogic constructor.
     * @param CanListProjectMilestones $canListProjectMilestones
     * @param ListsProjectMilestones $listsProjectMilestones
     */
    public function __construct(CanListProjectMilestones $canListProjectMilestones, ListsProjectMilestones $listsProjectMilestones)
    {
        $this->canListProjectMilestones = $canListProjectMilestones;
        $this->listsProjectMilestones = $listsProjectMilestones;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListProjectMilestones->passes();

            $query = $this->listsProjectMilestones->execute($this->listsProjectMilestones->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(ProjectMilestoneResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}