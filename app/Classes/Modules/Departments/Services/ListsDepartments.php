<?php

namespace App\Classes\Modules\Departments\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Department;

class ListsDepartments extends AbstractListRecord
{

    /** @var Department */
    private $repository;

    /**
     * ListsDepartments constructor.
     * @param Department $repository
     */
    public function __construct(Department $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return Builder
     */
    function getRepository(): Builder
    {
        return $this->repository->newQuery();
    }
}