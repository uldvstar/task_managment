<?php

namespace App\Classes\Modules\TaskAssignees\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\TaskAssignees\DataTransferObjects\TaskAssigneeObject;
use App\Classes\Modules\TaskAssignees\Standards\Validators\TaskAssigneeValidation;

class CanCreateTaskAssignee extends AbstractRule
{

    /** @var TaskAssigneeValidation */
    private $taskAssigneeValidation;

    /**
     * CanCreateTaskAssignee constructor.
     * @param TaskAssigneeValidation $taskAssigneeValidation
     */
    public function __construct(TaskAssigneeValidation $taskAssigneeValidation)
    {
        $this->taskAssigneeValidation = $taskAssigneeValidation;
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
     * @param TaskAssigneeObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->taskAssigneeValidation->validate($object);

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