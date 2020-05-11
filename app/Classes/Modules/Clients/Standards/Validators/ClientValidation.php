<?php

namespace App\Classes\Modules\Clients\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;

class ClientValidation extends AbstractValidation
{


    /**
     * @param ClientObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'type_id' => $object->getTypeId(),
            'marking' => $object->getMarking(),
            'name' => $object->getName(),
            'email' => $object->getEmail(),
            'wechat_id' => $object->getWechatId()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            'type_id' => 'required',
            'marking' => 'required',
            'name' => 'required',
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