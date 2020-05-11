<?php

namespace App\Classes\Modules\Clients\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;
use App\Classes\Modules\Clients\Standards\Validators\ClientValidation;

class CanCreateClient extends AbstractRule
{

    /** @var ClientValidation */
    private $clientValidation;

    /**
     * CanCreateClient constructor.
     * @param ClientValidation $clientValidation
     */
    public function __construct(ClientValidation $clientValidation)
    {
        $this->clientValidation = $clientValidation;
    }


    /**
     * @return bool
     */
    protected function authorized(): bool
    {
        // TODO  Set Authorization rules
        return true;

    }

    /**
     * @param ClientObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->clientValidation->validate($object);

    }


    /**
     * @param ClientObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}