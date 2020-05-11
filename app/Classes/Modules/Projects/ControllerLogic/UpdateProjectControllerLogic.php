<?php

namespace App\Classes\Modules\Projects\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Projects\Services\UpdatesProject;
use App\Classes\Modules\Projects\Services\FetchesProject;
use App\Classes\Modules\Projects\Standards\Rules\CanUpdateProject;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Http\Resources\ProjectResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateProjectControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Project',
            'message' => 'You have successfully updated the Project'
        ];
    }

    /** @var CanUpdateProject */
    private $canUpdateProject;

    /** @var UpdatesProject */
    private $updatesProject;

    /** @var FetchesProject */
    private $fetchesProject;

    /**
     * UpdateProjectControllerLogic constructor.
     * @param CanUpdateProject $canUpdateProject
     * @param UpdatesProject $updatesProject
     * @param FetchesProject $fetchesProject
     */
    public function __construct(CanUpdateProject $canUpdateProject, UpdatesProject $updatesProject, FetchesProject $fetchesProject)
    {
        $this->canUpdateProject = $canUpdateProject;
        $this->updatesProject = $updatesProject;
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

            $object = new ProjectObject($request->input('type_id'), $request->input('client_id'), $request->input('reference'), $request->input('description'), $request->input('status'));

            $this->canUpdateProject->passes($object);

            $query = $this->fetchesProject->execute(['id' => $request->route('id')]);

            $query = $this->updatesProject->execute($query, $object);

            return $this->resourceResponse(new ProjectResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}