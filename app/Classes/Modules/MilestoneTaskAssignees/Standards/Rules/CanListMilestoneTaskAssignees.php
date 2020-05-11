<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;

class CanListMilestoneTaskAssignees extends AbstractRule
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
     * @param MilestoneTaskAssigneeObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param MilestoneTaskAssigneeObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}