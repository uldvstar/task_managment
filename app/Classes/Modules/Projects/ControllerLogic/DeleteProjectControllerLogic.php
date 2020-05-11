<?php

namespace App\Classes\Modules\Projects\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Projects\Services\DeletesProject;
use App\Classes\Modules\Projects\Services\FetchesProject;
use App\Classes\Modules\Projects\Standards\Rules\CanDeleteProject;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteProjectControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Project',
            'message' => 'You have successfully deleted a Project'
        ];
    }


    /** @var CanDeleteProject */
    private $canDeleteProject;

    /** @var DeletesProject */
    private $deletesProject;

    /** @var FetchesProject */
        private $fetchesProject;

    /**
     * DeleteProjectControllerLogic constructor.
     * @param CanDeleteProject $canDeleteProject
     * @param DeletesProject $deletesProject
     * @param FetchesProject $fetchesProject
     */
    public function __construct(CanDeleteProject $canDeleteProject, DeletesProject $deletesProject, FetchesProject $fetchesProject)
    {
        $this->canDeleteProject = $canDeleteProject;
        $this->deletesProject = $deletesProject;
        $this->fetchesProject = $fetchesProject;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canDeleteProject->passes();

            $query = $this->fetchesProject->execute(['id' => $request->route('id')]);

            $this->deletesProject->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}