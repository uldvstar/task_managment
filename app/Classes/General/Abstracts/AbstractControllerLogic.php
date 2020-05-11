<?php

namespace App\Classes\General\Abstracts;


use App\Classes\ValueObjects\Constants\Notifications;
use App\Classes\ValueObjects\Constants\HttpStatus;
use App\Classes\ValueObjects\Response\ApiResponseObject;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class AbstractControllerLogic
{

    /**
     * @return array
     */
    abstract protected function notification(): array;

    /**
     * @return string
     */
    private function getNotificationTitle():string {
        return $this->notification()['title'] ? $this->notification()['title']: Notifications::UNDEFINED['title'];
    }

    /**
     * @return string
     */
    private function getNotificationMessage():string {
        return $this->notification()['message'] ? $this->notification()['message']: Notifications::UNDEFINED['message'];
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    abstract protected function logic(Request $request) : JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function execute(Request $request) : JsonResponse  {

        try {

            return $this->logic($request);

        } catch (ErrorException $exception){
            dd($exception->getMessage());
            return (new ApiResponseObject($this->getNotificationTitle().' failed', $exception->getMessage(), $exception->getCode()))->handler();

        }
    }

    /**
     * @param array|null $data
     * @return JsonResponse
     */
    public function response(?array $data = []) : JsonResponse {

        return (new ApiResponseObject($this->getNotificationTitle().' Successful',
            $this->getNotificationMessage(),
            HttpStatus::OK_WITH_MESSAGE, $data))->handler();
    }

    /**
     * @param JsonResource $resource
     * @return JsonResponse
     */
    public function resourceResponse(JsonResource $resource){
        return $this->response(['data' => $resource]);
    }

    /**
     * @param ResourceCollection $collection
     * @return JsonResponse
     */
    public function collectionResponse(ResourceCollection $collection){
        return $this->response(json_decode($collection->response()->getContent(), true));
    }

}