<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class RequestValidationException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'Unable to process the request due to validation failure', HttpStatus::VALIDATION_FAILED);
    }
}
