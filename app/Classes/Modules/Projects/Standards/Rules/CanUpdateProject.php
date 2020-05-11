<?php

namespace App\Classes\Modules\Projects\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Classes\Modules\Projects\Standards\Validators\ProjectValidation;

class CanUpdateProject extends AbstractRule
{

    /** @var ProjectValidation */
    private $projectValidation;

    /**
     * CanUpdateProject constructor.
     * @param ProjectValidation $projectValidation
     */
    public function __construct(ProjectValidation $projectValidation)
    {
        $this->projectValidation = $projectValidation;
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
     * @param ProjectObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->projectValidation->validate($object);

    }


    /**
     * @param ProjectObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}