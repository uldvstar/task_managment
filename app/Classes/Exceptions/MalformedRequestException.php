<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class MalformedRequestException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'Unable to process the request as it is malformed', HttpStatus::BAD_REQUEST);
    }
}
