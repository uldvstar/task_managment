<?php

namespace App\Classes\Modules\Accounts\Standards\Validators;

use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Accounts\DataTransferObjects\AuthenticationCredentialsObject;

class UserAuthenticationValidation extends AbstractValidation
{


    /**
     * @param AuthenticationCredentialsObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'email' => $object->getEmail(),
            'password' => $object->getPassword()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }




}