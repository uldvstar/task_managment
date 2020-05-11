<?php

namespace App\Classes\Modules\Accounts\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Exceptions\RequestValidationException;
use App\Classes\Exceptions\ResourceNotFoundException;
use App\Classes\Modules\Accounts\DataTransferObjects\PasswordResetObject;
use App\Classes\Modules\Accounts\Standards\Criteria\PasswordResetTokenExists;
use App\Classes\Modules\Accounts\Standards\Validators\ResetPasswordValidation;

class CanResetPassword extends AbstractRule
{

    /** @var ResetPasswordValidation */
    private $resetPasswordValidation;

    /** @var PasswordResetTokenExists */
    private $passwordResetTokenExists;

    /**
     * CanResetPassword constructor.
     * @param ResetPasswordValidation $resetPasswordValidation
     * @param PasswordResetTokenExists $passwordResetTokenExists
     */
    public function __construct(ResetPasswordValidation $resetPasswordValidation, PasswordResetTokenExists $passwordResetTokenExists)
    {
        $this->resetPasswordValidation = $resetPasswordValidation;
        $this->passwordResetTokenExists = $passwordResetTokenExists;
    }


    /**
     * @return bool
     */
    protected function authorized(): bool
    {
        return true;

    }

    /**
     * @param PasswordResetObject $object
     * @return bool
     * @throws RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->resetPasswordValidation->validate($object);

    }


    /**
     * @param PasswordResetObject $object
     * @return bool
     * @throws ResourceNotFoundException
     */
    protected function criteria($object): bool
    {
        return $this->passwordResetTokenExists->execute($object->getToken());
    }

}