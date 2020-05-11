<?php

namespace App\Classes\Modules\Tasks\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;

class CanDeleteTask extends AbstractRule
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
     * @param TaskObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param TaskObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}