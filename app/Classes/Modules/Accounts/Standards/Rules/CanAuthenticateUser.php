<?php

namespace App\Classes\Modules\Accounts\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Exceptions\RequestValidationException;
use App\Classes\Modules\Accounts\DataTransferObjects\AuthenticationCredentialsObject;
use App\Classes\Modules\Accounts\Standards\Validators\UserAuthenticationValidation;

class CanAuthenticateUser extends AbstractRule
{

    /** @var UserAuthenticationValidation */
    private $userAuthenticationValidation;

    /**
     * CanAuthenticateUser constructor.
     * @param UserAuthenticationValidation $userAuthenticationValidation
     */
    public function __construct(UserAuthenticationValidation $userAuthenticationValidation)
    {
        $this->userAuthenticationValidation = $userAuthenticationValidation;
    }

    /**
     * @return bool
     */
    protected function authorized(): bool
    {
        return true;

    }


    /**
     * @param AuthenticationCredentialsObject $object
     * @return bool
     * @throws RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->userAuthenticationValidation->validate($object);

    }


    /**
     * @param AuthenticationCredentialsObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}