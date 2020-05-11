<?php

namespace App\Classes\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;


class ErrorException extends Exception {

    /**
     * ErrorException constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = 0) {
        parent::__construct($message, $code);
    }
}
