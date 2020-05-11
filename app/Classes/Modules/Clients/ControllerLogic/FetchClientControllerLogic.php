<?php

namespace App\Classes\Modules\Clients\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Clients\Services\FetchesClient;
use App\Classes\Modules\Clients\Standards\Rules\CanFetchClient;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;
use App\Http\Resources\ClientResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchClientControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Client',
            'message' => 'You have successfully retrieved a Client'
        ];
    }

    /** @var CanFetchClient */
    private $canFetchClient;

    /** @var FetchesClient */
    private $fetchesClient;

    /**
     * FetchClientControllerLogic constructor.
     * @param CanFetchClient $canFetchClient
     * @param FetchesClient $fetchesClient
     */
    public function __construct(CanFetchClient $canFetchClient, FetchesClient $fetchesClient)
    {
        $this->canFetchClient = $canFetchClient;
        $this->fetchesClient = $fetchesClient;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canFetchClient->passes();

            $query = $this->fetchesClient->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new ClientResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}