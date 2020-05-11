<?php

namespace App\Classes\Exceptions;

abstract class ServiceApiException extends ErrorException {

    public function __construct(string $message, int $httpStatusCode = 500) {
        parent::__construct($message, $httpStatusCode);
        $this->httpStatusCode = $httpStatusCode;
    }
}
