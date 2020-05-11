<?php

namespace App\Classes\Modules\ModularTypes\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;
use App\Classes\Modules\ModularTypes\Standards\Validators\ModularTypeValidation;

class CanUpdateModularType extends AbstractRule
{

    /** @var ModularTypeValidation */
    private $modularTypeValidation;

    /**
     * CanUpdateModularType constructor.
     * @param ModularTypeValidation $modularTypeValidation
     */
    public function __construct(ModularTypeValidation $modularTypeValidation)
    {
        $this->modularTypeValidation = $modularTypeValidation;
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
     * @param ModularTypeObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->modularTypeValidation->validate($object);

    }


    /**
     * @param ModularTypeObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}