<?php

namespace App\Classes\Modules\Clients\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Clients\Services\CreatesClient;
use App\Classes\Modules\Clients\Standards\Rules\CanCreateClient;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;
use App\Http\Resources\ClientResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateClientControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Client',
            'message' => 'You have successfully created a new Client'
        ];
    }

    /** @var CanCreateClient */
    private $canCreateClient;

    /** @var CreatesClient */
    private $createsClient;

    /**
     * CreateClientControllerLogic constructor.
     * @param CanCreateClient $canCreateClient
     * @param CreatesClient $createsClient
     */
    public function __construct(CanCreateClient $canCreateClient, CreatesClient $createsClient)
    {
        $this->canCreateClient = $canCreateClient;
        $this->createsClient = $createsClient;
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

            $this->canCreateClient->passes($object);

            $query = $this->createsClient->execute($object);

            return $this->resourceResponse(new ClientResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}