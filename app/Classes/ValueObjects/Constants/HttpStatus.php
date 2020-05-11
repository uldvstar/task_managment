<?php

namespace App\Classes\ValueObjects\Constants;

final class HttpStatus {
    public const OK_WITH_MESSAGE = 200;

    public const RESOURCE_CREATED = 201;

    public const REQUEST_ACCEPTED = 202;

    public const OK = 204;

    public const BAD_REQUEST = 400;

    public const ACCESS_UNAUTHORISED = 401;

    public const ACCESS_FORBIDDEN = 403;

    public const RESOURCE_NOT_FOUND = 404;

    public const METHOD_NOT_FOUND = 405;

    public const RESOURCE_ALREADY_EXISTS = 409;

    public const VALIDATION_FAILED = 422;

    public const SERVER_ERROR = 500;
}
