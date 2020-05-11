<?php

namespace App\Classes\Modules\Accounts\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Exceptions\RequestValidationException;
use App\Classes\Exceptions\ResourceNotFoundException;
use App\Classes\Modules\Accounts\DataTransferObjects\GeneratePasswordResetObject;
use App\Classes\Modules\Accounts\Standards\Criteria\UserEmailExists;
use App\Classes\Modules\Accounts\Standards\Validators\GeneratePasswordResetValidation;

class CanGeneratePasswordReset extends AbstractRule
{

    /** @var GeneratePasswordResetValidation */
    private $generatePasswordResetValidation;

    /** @var UserEmailExists */
    private $userEmailExists;

    /**
     * CanGeneratePasswordReset constructor.
     * @param GeneratePasswordResetValidation $generatePasswordResetValidation
     * @param UserEmailExists $userEmailExists
     */
    public function __construct(GeneratePasswordResetValidation $generatePasswordResetValidation, UserEmailExists $userEmailExists)
    {
        $this->generatePasswordResetValidation = $generatePasswordResetValidation;
        $this->userEmailExists = $userEmailExists;
    }

    /**
     * @return bool
     */
    protected function authorized(): bool
    {
        return true;

    }


    /**
     * @param GeneratePasswordResetObject $object
     * @return bool
     * @throws RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->generatePasswordResetValidation->validate($object);
    }


    /**
     * @param GeneratePasswordResetObject $object
     * @return bool
     * @throws ResourceNotFoundException
     */
    protected function criteria($object): bool
    {
        return $this->userEmailExists->execute($object->getEmail());
    }


}