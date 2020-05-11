<?php

namespace App\Classes\Modules\Milestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Milestones\Services\DeletesMilestone;
use App\Classes\Modules\Milestones\Services\FetchesMilestone;
use App\Classes\Modules\Milestones\Standards\Rules\CanDeleteMilestone;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMilestoneControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Milestone',
            'message' => 'You have successfully deleted a Milestone'
        ];
    }


    /** @var CanDeleteMilestone */
    private $canDeleteMilestone;

    /** @var DeletesMilestone */
    private $deletesMilestone;

    /** @var FetchesMilestone */
        private $fetchesMilestone;

    /**
     * DeleteMilestoneControllerLogic constructor.
     * @param CanDeleteMilestone $canDeleteMilestone
     * @param DeletesMilestone $deletesMilestone
     * @param FetchesMilestone $fetchesMilestone
     */
    public function __construct(CanDeleteMilestone $canDeleteMilestone, DeletesMilestone $deletesMilestone, FetchesMilestone $fetchesMilestone)
    {
        $this->canDeleteMilestone = $canDeleteMilestone;
        $this->deletesMilestone = $deletesMilestone;
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

            $this->canDeleteMilestone->passes();

            $query = $this->fetchesMilestone->execute(['id' => $request->route('id')]);

            $this->deletesMilestone->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}