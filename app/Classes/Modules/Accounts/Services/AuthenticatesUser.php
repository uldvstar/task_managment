<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\Exceptions\AccessUnauthorisedException;
use App\Classes\Modules\Accounts\DataTransferObjects\AuthenticationCredentialsObject;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticatesUser
{

    /**
     * @param AuthenticationCredentialsObject $object
     * @return false|string
     * @throws AccessUnauthorisedException
     */
    public function execute(AuthenticationCredentialsObject $object){

        if (! $token = JWTAuth::attempt(['email' => $object->getEmail(), 'password' => $object->getPassword()])) {
            throw new AccessUnauthorisedException('These credentials do not match our records.');
        }

        return $token;
    }

}