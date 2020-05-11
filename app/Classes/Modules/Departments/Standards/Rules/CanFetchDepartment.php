<?php

namespace App\Classes\Modules\Departments\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;

class CanFetchDepartment extends AbstractRule
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
     * @param DepartmentObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param DepartmentObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}