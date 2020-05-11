<?php

namespace App\Classes\Modules\ModularTypes\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\ModularTypes\DataTransferObjects\ModularTypeObject;

class CanListModularTypes extends AbstractRule
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
     * @param ModularTypeObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

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