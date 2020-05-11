<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class AccessForbiddenException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'A forbidden attempt to access protected resources was detected',
            HttpStatus::ACCESS_FORBIDDEN);
    }
}
