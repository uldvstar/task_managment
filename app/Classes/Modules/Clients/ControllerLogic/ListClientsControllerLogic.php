<?php

namespace App\Classes\Modules\Clients\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Clients\Services\ListsClients;
use App\Classes\Modules\Clients\Standards\Rules\CanListClients;
use App\Http\Resources\ClientResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListClientsControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Clients',
            'message' => 'You have successfully retrieved a list of Clients'
        ];
    }

    /** @var CanListClients */
    private $canListClients;

    /** @var ListsClients */
    private $listsClients;

    /**
     * ListClientsControllerLogic constructor.
     * @param CanListClients $canListClients
     * @param ListsClients $listsClients
     */
    public function __construct(CanListClients $canListClients, ListsClients $listsClients)
    {
        $this->canListClients = $canListClients;
        $this->listsClients = $listsClients;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListClients->passes();

            $query = $this->listsClients->execute($this->listsClients->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(ClientResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}