<?php

namespace App\Classes\Modules\MilestoneTasks\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;

class CanFetchMilestoneTask extends AbstractRule
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
     * @param MilestoneTaskObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param MilestoneTaskObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}