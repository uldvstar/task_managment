<?php

namespace App\Classes\Modules\TaskAssignees\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;

class CanFetchTaskAssignee extends AbstractRule
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
     * @param TaskAssigneeObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param TaskAssigneeObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}