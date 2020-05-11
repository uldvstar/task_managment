<?php

namespace App\Classes\Modules\Accounts\ControllerLogic;


use App\Classes\Exceptions\AccessUnauthorisedException;
use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Accounts\DataTransferObjects\AuthenticationCredentialsObject;
use App\Classes\Modules\Accounts\Services\AuthenticatesUser;
use App\Classes\Modules\Accounts\Standards\Rules\CanAuthenticateUser;
use App\Classes\ValueObjects\Constants\Notifications;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return Notifications::AUTHENTICATION;
    }

    /** @var CanAuthenticateUser */
    private $canAuthenticateUser;

    /** @var AuthenticatesUser */
    private $authenticatesUser;

    /**
     * AuthenticateUserLogic constructor.
     * @param CanAuthenticateUser $canAuthenticateUser
     * @param AuthenticatesUser $authenticatesUser
     */
    public function __construct(CanAuthenticateUser $canAuthenticateUser, AuthenticatesUser $authenticatesUser)
    {
        $this->canAuthenticateUser = $canAuthenticateUser;
        $this->authenticatesUser = $authenticatesUser;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    protected function logic(Request $request): JsonResponse {
        try {

            $object = new AuthenticationCredentialsObject($request->input('email'),
                $request->input('password'), $request->input('remember_me'));

            if($this->canAuthenticateUser->passes($object)){

                $token = $this->authenticatesUser->execute($object);

                // sets session for securing web routes
                session(['access_token' => $token]);

                return $this->response(['access_token' => $token]);

            }

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}