<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class InternalServerErrorException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'An internal server error has occurred. Please check application logs for more information.',
            HttpStatus::SERVER_ERROR);
    }
}
