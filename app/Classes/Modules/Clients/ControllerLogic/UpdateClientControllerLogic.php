<?php

namespace App\Classes\Modules\Clients\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Clients\Services\UpdatesClient;
use App\Classes\Modules\Clients\Services\FetchesClient;
use App\Classes\Modules\Clients\Standards\Rules\CanUpdateClient;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;
use App\Http\Resources\ClientResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateClientControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Client',
            'message' => 'You have successfully updated the Client'
        ];
    }

    /** @var CanUpdateClient */
    private $canUpdateClient;

    /** @var UpdatesClient */
    private $updatesClient;

    /** @var FetchesClient */
    private $fetchesClient;

    /**
     * UpdateClientControllerLogic constructor.
     * @param CanUpdateClient $canUpdateClient
     * @param UpdatesClient $updatesClient
     * @param FetchesClient $fetchesClient
     */
    public function __construct(CanUpdateClient $canUpdateClient, UpdatesClient $updatesClient, FetchesClient $fetchesClient)
    {
        $this->canUpdateClient = $canUpdateClient;
        $this->updatesClient = $updatesClient;
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

            $object = new ClientObject($request->input('type_id'), $request->input('marking'), $request->input('name'), $request->input('email'), $request->input('wechat_id'));

            $this->canUpdateClient->passes($object);

            $query = $this->fetchesClient->execute(['id' => $request->route('id')]);

            $query = $this->updatesClient->execute($query, $object);

            return $this->resourceResponse(new ClientResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}