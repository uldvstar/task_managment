<?php

namespace App\Http\Middleware;

use App\Classes\ValueObjects\Constants\HttpStatus;
use App\Classes\ValueObjects\Response\ApiResponseObject;
use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class ValidateToken
{
    /**
     * Checks if jwt token is valid.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return (new ApiResponseObject('Authentication', 'To keep your account secure we need to re-validate your account', HttpStatus::ACCESS_UNAUTHORISED))->handler();
        }

        return $next($request);
    }
}
