<?php

namespace App\Classes\Modules\Milestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Milestones\Services\UpdatesMilestone;
use App\Classes\Modules\Milestones\Services\FetchesMilestone;
use App\Classes\Modules\Milestones\Standards\Rules\CanUpdateMilestone;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;
use App\Http\Resources\MilestoneResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMilestoneControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Milestone',
            'message' => 'You have successfully updated the Milestone'
        ];
    }

    /** @var CanUpdateMilestone */
    private $canUpdateMilestone;

    /** @var UpdatesMilestone */
    private $updatesMilestone;

    /** @var FetchesMilestone */
    private $fetchesMilestone;

    /**
     * UpdateMilestoneControllerLogic constructor.
     * @param CanUpdateMilestone $canUpdateMilestone
     * @param UpdatesMilestone $updatesMilestone
     * @param FetchesMilestone $fetchesMilestone
     */
    public function __construct(CanUpdateMilestone $canUpdateMilestone, UpdatesMilestone $updatesMilestone, FetchesMilestone $fetchesMilestone)
    {
        $this->canUpdateMilestone = $canUpdateMilestone;
        $this->updatesMilestone = $updatesMilestone;
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

            $object = new MilestoneObject($request->input('project_type'), $request->input('name'), $request->input('order'));

            $this->canUpdateMilestone->passes($object);

            $query = $this->fetchesMilestone->execute(['id' => $request->route('id')]);

            $query = $this->updatesMilestone->execute($query, $object);

            return $this->resourceResponse(new MilestoneResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}