<?php

namespace App\Classes\Modules\Tasks\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Tasks\DataTransferObjects\TaskObject;
use App\Classes\Modules\Tasks\Standards\Validators\TaskValidation;

class CanUpdateTask extends AbstractRule
{

    /** @var TaskValidation */
    private $taskValidation;

    /**
     * CanUpdateTask constructor.
     * @param TaskValidation $taskValidation
     */
    public function __construct(TaskValidation $taskValidation)
    {
        $this->taskValidation = $taskValidation;
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
     * @param TaskObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->taskValidation->validate($object);

    }


    /**
     * @param TaskObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}