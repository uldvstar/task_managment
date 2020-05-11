<?php

namespace App\Classes\Modules\ModularTypes\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ModularTypes\Services\CreatesModularType;
use App\Classes\Modules\ModularTypes\Standards\Rules\CanCreateModularType;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Classes\ValueObjects\Constants\ModularTypes;
use App\Http\Resources\ModularTypeResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateModularTypeControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Modular Type',
            'message' => 'You have successfully created a new Modular Type'
        ];
    }

    /** @var CanCreateModularType */
    private $canCreateModularType;

    /** @var CreatesModularType */
    private $createsModularType;

    /**
     * CreateModularTypeControllerLogic constructor.
     * @param CanCreateModularType $canCreateModularType
     * @param CreatesModularType $createsModularType
     */
    public function __construct(CanCreateModularType $canCreateModularType, CreatesModularType $createsModularType)
    {
        $this->canCreateModularType = $canCreateModularType;
        $this->createsModularType = $createsModularType;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {
            $object = new ModularTypeObject(ModularTypes::MODULAR_MODULES[$request->route('type')], $request->input('name'), $request->input('reference'), $request->input('description'));

            $this->canCreateModularType->passes($object);

            $query = $this->createsModularType->execute($object);

            return $this->resourceResponse(new ModularTypeResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}