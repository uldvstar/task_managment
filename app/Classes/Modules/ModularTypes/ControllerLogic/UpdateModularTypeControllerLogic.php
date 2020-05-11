<?php

namespace App\Classes\Modules\ModularTypes\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ModularTypes\Services\UpdatesModularType;
use App\Classes\Modules\ModularTypes\Services\FetchesModularType;
use App\Classes\Modules\ModularTypes\Standards\Rules\CanUpdateModularType;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Http\Resources\ModularTypeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateModularTypeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Modular Type',
            'message' => 'You have successfully updated the Modular Type'
        ];
    }

    /** @var CanUpdateModularType */
    private $canUpdateModularType;

    /** @var UpdatesModularType */
    private $updatesModularType;

    /** @var FetchesModularType */
    private $fetchesModularType;

    /**
     * UpdateModularTypeControllerLogic constructor.
     * @param CanUpdateModularType $canUpdateModularType
     * @param UpdatesModularType $updatesModularType
     * @param FetchesModularType $fetchesModularType
     */
    public function __construct(CanUpdateModularType $canUpdateModularType, UpdatesModularType $updatesModularType, FetchesModularType $fetchesModularType)
    {
        $this->canUpdateModularType = $canUpdateModularType;
        $this->updatesModularType = $updatesModularType;
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

            $object = new ModularTypeObject($request->input('module_type'), $request->input('name'), $request->input('reference'), $request->input('description'));

            $this->canUpdateModularType->passes($object);

            $query = $this->fetchesModularType->execute(['id' => $request->route('id')]);

            $query = $this->updatesModularType->execute($query, $object);

            return $this->resourceResponse(new ModularTypeResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}