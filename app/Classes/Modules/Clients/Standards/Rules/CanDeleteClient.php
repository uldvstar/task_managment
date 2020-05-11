<?php

namespace App\Classes\Modules\Clients\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Clients\DataTransferObjects\ClientObject;

class CanDeleteClient extends AbstractRule
{


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
     */
    protected function validators($object): bool
    {
        return true;

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