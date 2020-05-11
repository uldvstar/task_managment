<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class ResourceConflictException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'Unable to create the requested resource as it already exists',
            HttpStatus::RESOURCE_ALREADY_EXISTS);
    }
}
