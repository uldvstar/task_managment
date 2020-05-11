<?php

namespace App\Classes\Modules\Departments\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Departments\DataTransferObjects\DepartmentObject;
use App\Classes\Modules\Departments\Standards\Validators\DepartmentValidation;

class CanUpdateDepartment extends AbstractRule
{

    /** @var DepartmentValidation */
    private $departmentValidation;

    /**
     * CanUpdateDepartment constructor.
     * @param DepartmentValidation $departmentValidation
     */
    public function __construct(DepartmentValidation $departmentValidation)
    {
        $this->departmentValidation = $departmentValidation;
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
     * @param DepartmentObject $object
     * @return bool
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->departmentValidation->validate($object);

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