<?php

namespace App\Classes\Modules\ModularTypes\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ModularTypes\Services\FetchesModularType;
use App\Classes\Modules\ModularTypes\Standards\Rules\CanFetchModularType;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Http\Resources\ModularTypeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchModularTypeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Modular Type',
            'message' => 'You have successfully retrieved a Modular Type'
        ];
    }

    /** @var CanFetchModularType */
    private $canFetchModularType;

    /** @var FetchesModularType */
    private $fetchesModularType;

    /**
     * FetchModularTypeControllerLogic constructor.
     * @param CanFetchModularType $canFetchModularType
     * @param FetchesModularType $fetchesModularType
     */
    public function __construct(CanFetchModularType $canFetchModularType, FetchesModularType $fetchesModularType)
    {
        $this->canFetchModularType = $canFetchModularType;
        $this->fetchesModularType = $fetchesModularType;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canFetchModularType->passes();

            $query = $this->fetchesModularType->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new ModularTypeResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}