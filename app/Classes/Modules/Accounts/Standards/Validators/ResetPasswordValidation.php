<?php

namespace App\Classes\Modules\Accounts\Standards\Validators;

use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Accounts\DataTransferObjects\PasswordResetObject;

class ResetPasswordValidation extends AbstractValidation
{


    /**
     * @param PasswordResetObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'token' => $object->getToken(),
            'password' => $object->getNewPassword()->getPassword(),
            'confirm_password' => $object->getNewPassword()->getConfirmPassword()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'token' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'same:password'

        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [
            'confirm_password' => [
                'same' => 'The :attribute and :other must match.'
            ]
        ];
    }




}