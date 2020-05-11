<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class AccessUnauthorisedException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'An unauthorised attempt to access protected resources was detected',
            HttpStatus::ACCESS_UNAUTHORISED);
    }
}
