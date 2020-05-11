<?php

namespace App\Classes\Modules\Accounts\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;

class CanListUsers extends AbstractRule
{


    /**
     * @return bool
     */
    protected function authorized(): bool
    {
        return true;

    }


    /**
     * @param $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    protected function criteria($object): bool
    {
        return true;
    }

}