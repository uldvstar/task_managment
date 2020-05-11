<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\MilestoneTaskAssignees\DataTransferObjects\MilestoneTaskAssigneeObject;
use App\Classes\Modules\MilestoneTaskAssignees\Standards\Validators\MilestoneTaskAssigneeValidation;

class CanUpdateMilestoneTaskAssignee extends AbstractRule
{

    /** @var MilestoneTaskAssigneeValidation */
    private $milestoneTaskAssigneeValidation;

    /**
     * CanUpdateMilestoneTaskAssignee constructor.
     * @param MilestoneTaskAssigneeValidation $milestoneTaskAssigneeValidation
     */
    public function __construct(MilestoneTaskAssigneeValidation $milestoneTaskAssigneeValidation)
    {
        $this->milestoneTaskAssigneeValidation = $milestoneTaskAssigneeValidation;
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
     * @param MilestoneTaskAssigneeObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->milestoneTaskAssigneeValidation->validate($object);

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