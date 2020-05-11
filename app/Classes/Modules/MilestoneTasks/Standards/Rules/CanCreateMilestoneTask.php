<?php

namespace App\Classes\Modules\MilestoneTasks\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\MilestoneTasks\DataTransferObjects\MilestoneTaskObject;
use App\Classes\Modules\MilestoneTasks\Standards\Validators\MilestoneTaskValidation;

class CanCreateMilestoneTask extends AbstractRule
{

    /** @var MilestoneTaskValidation */
    private $milestoneTaskValidation;

    /**
     * CanCreateMilestoneTask constructor.
     * @param MilestoneTaskValidation $milestoneTaskValidation
     */
    public function __construct(MilestoneTaskValidation $milestoneTaskValidation)
    {
        $this->milestoneTaskValidation = $milestoneTaskValidation;
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
     * @param MilestoneTaskObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->milestoneTaskValidation->validate($object);

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