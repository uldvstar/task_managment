<?php

namespace App\Classes\Modules\ProjectMilestones\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ProjectMilestones\Services\DeletesProjectMilestone;
use App\Classes\Modules\ProjectMilestones\Services\FetchesProjectMilestone;
use App\Classes\Modules\ProjectMilestones\Standards\Rules\CanDeleteProjectMilestone;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteProjectMilestoneControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Project Milestone',
            'message' => 'You have successfully deleted a Project Milestone'
        ];
    }


    /** @var CanDeleteProjectMilestone */
    private $canDeleteProjectMilestone;

    /** @var DeletesProjectMilestone */
    private $deletesProjectMilestone;

    /** @var FetchesProjectMilestone */
        private $fetchesProjectMilestone;

    /**
     * DeleteProjectMilestoneControllerLogic constructor.
     * @param CanDeleteProjectMilestone $canDeleteProjectMilestone
     * @param DeletesProjectMilestone $deletesProjectMilestone
     * @param FetchesProjectMilestone $fetchesProjectMilestone
     */
    public function __construct(CanDeleteProjectMilestone $canDeleteProjectMilestone, DeletesProjectMilestone $deletesProjectMilestone, FetchesProjectMilestone $fetchesProjectMilestone)
    {
        $this->canDeleteProjectMilestone = $canDeleteProjectMilestone;
        $this->deletesProjectMilestone = $deletesProjectMilestone;
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

            $this->canDeleteProjectMilestone->passes();

            $query = $this->fetchesProjectMilestone->execute(['id' => $request->route('id')]);

            $this->deletesProjectMilestone->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}