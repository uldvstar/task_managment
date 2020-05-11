<?php

namespace App\Classes\Exceptions;

use App\Classes\ValueObjects\Constants\HttpStatus;

final class ResourceNotFoundException extends ServiceApiException {
    public function __construct(?string $message = null) {
        parent::__construct($message ?? 'Unable to find the requested resource', HttpStatus::RESOURCE_NOT_FOUND);
    }
}
