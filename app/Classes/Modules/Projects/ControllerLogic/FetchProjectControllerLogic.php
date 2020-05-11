<?php

namespace App\Classes\Modules\Projects\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Projects\Services\FetchesProject;
use App\Classes\Modules\Projects\Standards\Rules\CanFetchProject;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Http\Resources\ProjectResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchProjectControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Project',
            'message' => 'You have successfully retrieved a Project'
        ];
    }

    /** @var CanFetchProject */
    private $canFetchProject;

    /** @var FetchesProject */
    private $fetchesProject;

    /**
     * FetchProjectControllerLogic constructor.
     * @param CanFetchProject $canFetchProject
     * @param FetchesProject $fetchesProject
     */
    public function __construct(CanFetchProject $canFetchProject, FetchesProject $fetchesProject)
    {
        $this->canFetchProject = $canFetchProject;
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

            $this->canFetchProject->passes();

            $query = $this->fetchesProject->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new ProjectResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}