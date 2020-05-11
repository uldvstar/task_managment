<?php

namespace App\Classes\Modules\Milestones\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;

class CanListMilestones extends AbstractRule
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
     * @param MilestoneObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param MilestoneObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}