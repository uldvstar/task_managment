<?php

namespace App\Classes\Modules\Projects\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Projects\Services\ListsProjects;
use App\Classes\Modules\Projects\Standards\Rules\CanListProjects;
use App\Http\Resources\ProjectResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListProjectsControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Projects',
            'message' => 'You have successfully retrieved a list of Projects'
        ];
    }

    /** @var CanListProjects */
    private $canListProjects;

    /** @var ListsProjects */
    private $listsProjects;

    /**
     * ListProjectsControllerLogic constructor.
     * @param CanListProjects $canListProjects
     * @param ListsProjects $listsProjects
     */
    public function __construct(CanListProjects $canListProjects, ListsProjects $listsProjects)
    {
        $this->canListProjects = $canListProjects;
        $this->listsProjects = $listsProjects;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListProjects->passes();

            $query = $this->listsProjects->execute($this->listsProjects->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(ProjectResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}