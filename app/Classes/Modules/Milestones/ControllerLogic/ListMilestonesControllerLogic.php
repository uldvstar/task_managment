<?php

namespace App\Classes\Modules\Milestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Milestones\Services\ListsMilestones;
use App\Classes\Modules\Milestones\Standards\Rules\CanListMilestones;
use App\Http\Resources\MilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMilestonesControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Milestones',
            'message' => 'You have successfully retrieved a list of Milestones'
        ];
    }

    /** @var CanListMilestones */
    private $canListMilestones;

    /** @var ListsMilestones */
    private $listsMilestones;

    /**
     * ListMilestonesControllerLogic constructor.
     * @param CanListMilestones $canListMilestones
     * @param ListsMilestones $listsMilestones
     */
    public function __construct(CanListMilestones $canListMilestones, ListsMilestones $listsMilestones)
    {
        $this->canListMilestones = $canListMilestones;
        $this->listsMilestones = $listsMilestones;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListMilestones->passes();

            $query = $this->listsMilestones->execute(array_merge($this->listsMilestones->deserializeFilters($request->input('filters')), ['project_type' =>  $request->route('service_id')]));

            return $this->collectionResponse(MilestoneResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}