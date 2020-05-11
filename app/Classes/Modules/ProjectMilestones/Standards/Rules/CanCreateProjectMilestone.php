<?php

namespace App\Classes\Modules\ProjectMilestones\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\ProjectMilestones\DataTransferObjects\ProjectMilestoneObject;
use App\Classes\Modules\ProjectMilestones\Standards\Validators\ProjectMilestoneValidation;

class CanCreateProjectMilestone extends AbstractRule
{

    /** @var ProjectMilestoneValidation */
    private $projectMilestoneValidation;

    /**
     * CanCreateProjectMilestone constructor.
     * @param ProjectMilestoneValidation $projectMilestoneValidation
     */
    public function __construct(ProjectMilestoneValidation $projectMilestoneValidation)
    {
        $this->projectMilestoneValidation = $projectMilestoneValidation;
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
     * @param ProjectMilestoneObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->projectMilestoneValidation->validate($object);

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