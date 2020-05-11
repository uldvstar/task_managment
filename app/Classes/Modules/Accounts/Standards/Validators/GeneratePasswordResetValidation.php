<?php

namespace App\Classes\Modules\Accounts\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Accounts\DataTransferObjects\GeneratePasswordResetObject;

class GeneratePasswordResetValidation extends AbstractValidation
{


    /**
     * @param GeneratePasswordResetObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'email' => $object->getEmail()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'email' => 'required|email'
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }




}