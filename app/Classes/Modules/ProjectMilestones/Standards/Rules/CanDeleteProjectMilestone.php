<?php

namespace App\Classes\Modules\ProjectMilestones\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;

class CanDeleteProjectMilestone extends AbstractRule
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
     * @param ProjectMilestoneObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param ProjectMilestoneObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}