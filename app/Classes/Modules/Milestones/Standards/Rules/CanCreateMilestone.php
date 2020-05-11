<?php

namespace App\Classes\Modules\Milestones\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Milestones\DataTransferObjects\MilestoneObject;
use App\Classes\Modules\Milestones\Standards\Validators\MilestoneValidation;

class CanCreateMilestone extends AbstractRule
{

    /** @var MilestoneValidation */
    private $milestoneValidation;

    /**
     * CanCreateMilestone constructor.
     * @param MilestoneValidation $milestoneValidation
     */
    public function __construct(MilestoneValidation $milestoneValidation)
    {
        $this->milestoneValidation = $milestoneValidation;
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
     * @param MilestoneObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->milestoneValidation->validate($object);

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