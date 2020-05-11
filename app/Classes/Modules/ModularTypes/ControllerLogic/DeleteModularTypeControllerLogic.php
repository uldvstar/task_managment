<?php

namespace App\Classes\Modules\ModularTypes\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\ModularTypes\Services\DeletesModularType;
use App\Classes\Modules\ModularTypes\Services\FetchesModularType;
use App\Classes\Modules\ModularTypes\Standards\Rules\CanDeleteModularType;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteModularTypeControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Modular Type',
            'message' => 'You have successfully deleted a Modular Type'
        ];
    }


    /** @var CanDeleteModularType */
    private $canDeleteModularType;

    /** @var DeletesModularType */
    private $deletesModularType;

    /** @var FetchesModularType */
        private $fetchesModularType;

    /**
     * DeleteModularTypeControllerLogic constructor.
     * @param CanDeleteModularType $canDeleteModularType
     * @param DeletesModularType $deletesModularType
     * @param FetchesModularType $fetchesModularType
     */
    public function __construct(CanDeleteModularType $canDeleteModularType, DeletesModularType $deletesModularType, FetchesModularType $fetchesModularType)
    {
        $this->canDeleteModularType = $canDeleteModularType;
        $this->deletesModularType = $deletesModularType;
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

            $this->canDeleteModularType->passes();

            $query = $this->fetchesModularType->execute(['id' => $request->route('id')]);

            $this->deletesModularType->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}