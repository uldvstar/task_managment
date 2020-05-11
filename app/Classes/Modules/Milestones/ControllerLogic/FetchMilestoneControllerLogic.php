<?php

namespace App\Classes\Modules\Milestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Milestones\Services\FetchesMilestone;
use App\Classes\Modules\Milestones\Standards\Rules\CanFetchMilestone;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;
use App\Http\Resources\MilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchMilestoneControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Milestone',
            'message' => 'You have successfully retrieved a Milestone'
        ];
    }

    /** @var CanFetchMilestone */
    private $canFetchMilestone;

    /** @var FetchesMilestone */
    private $fetchesMilestone;

    /**
     * FetchMilestoneControllerLogic constructor.
     * @param CanFetchMilestone $canFetchMilestone
     * @param FetchesMilestone $fetchesMilestone
     */
    public function __construct(CanFetchMilestone $canFetchMilestone, FetchesMilestone $fetchesMilestone)
    {
        $this->canFetchMilestone = $canFetchMilestone;
        $this->fetchesMilestone = $fetchesMilestone;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canFetchMilestone->passes();

            $query = $this->fetchesMilestone->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new MilestoneResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}