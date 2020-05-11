<?php

namespace App\Classes\Modules\ModularTypes\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ModularTypes\Services\ListsModularTypes;
use App\Classes\Modules\ModularTypes\Standards\Rules\CanListModularTypes;
use App\Http\Resources\ModularTypeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListModularTypesControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Modular Types',
            'message' => 'You have successfully retrieved a list of Modular Types'
        ];
    }

    /** @var CanListModularTypes */
    private $canListModularTypes;

    /** @var ListsModularTypes */
    private $listsModularTypes;

    /**
     * ListModularTypesControllerLogic constructor.
     * @param CanListModularTypes $canListModularTypes
     * @param ListsModularTypes $listsModularTypes
     */
    public function __construct(CanListModularTypes $canListModularTypes, ListsModularTypes $listsModularTypes)
    {
        $this->canListModularTypes = $canListModularTypes;
        $this->listsModularTypes = $listsModularTypes;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListModularTypes->passes();
            $query = $this->listsModularTypes->execute(array_merge($this->listsModularTypes->deserializeFilters($request->input('filters')), ['module_type' =>  $request->route('type')]));

            return $this->collectionResponse(ModularTypeResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}