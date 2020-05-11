<?php

namespace App\Classes\Modules\Clients\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Clients\Services\DeletesClient;
use App\Classes\Modules\Clients\Services\FetchesClient;
use App\Classes\Modules\Clients\Standards\Rules\CanDeleteClient;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteClientControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Client',
            'message' => 'You have successfully deleted a Client'
        ];
    }


    /** @var CanDeleteClient */
    private $canDeleteClient;

    /** @var DeletesClient */
    private $deletesClient;

    /** @var FetchesClient */
        private $fetchesClient;

    /**
     * DeleteClientControllerLogic constructor.
     * @param CanDeleteClient $canDeleteClient
     * @param DeletesClient $deletesClient
     * @param FetchesClient $fetchesClient
     */
    public function __construct(CanDeleteClient $canDeleteClient, DeletesClient $deletesClient, FetchesClient $fetchesClient)
    {
        $this->canDeleteClient = $canDeleteClient;
        $this->deletesClient = $deletesClient;
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

            $this->canDeleteClient->passes();

            $query = $this->fetchesClient->execute(['id' => $request->route('id')]);

            $this->deletesClient->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}