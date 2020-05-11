<?php

namespace App\Classes\Modules\Projects\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;

class CanFetchProject extends AbstractRule
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
     * @param ProjectObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param ProjectObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}