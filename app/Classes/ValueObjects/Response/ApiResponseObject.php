<?php

namespace App\Classes\ValueObjects\Response;


use Illuminate\Http\JsonResponse;

class ApiResponseObject
{

    /** @var string */
    private $title;

    /** @var string */
    private $message;

    /** @var int */
    private $statusCode;

    /** @var array */
    private $data;



    /**
     * ApiResponseObject constructor.
     * @param string $title
     * @param string $message
     * @param int $statusCode
     * @param array|null $data
     */
    public function __construct(string $title, string $message, int $statusCode, array $data = [])
    {
        $this->title = $title;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->data = $data;

    }

    /**
     * @return JsonResponse
     */
    public function handler(){
        return new JsonResponse(['title' => $this->getTitle(), 'message' => $this->getMessage(), 'payload' => $this->getData()], $this->getStatusCode());
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}