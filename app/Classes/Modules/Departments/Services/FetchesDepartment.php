<?php

namespace App\Classes\Modules\Departments\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Department;

class FetchesDepartment extends AbstractFetchRecord
{

    /** @var Department */
    private $repository;

    /**
     * FetchesDepartment constructor.
     * @param Department $repository
     */
    public function __construct(Department $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return Builder
     */
    public function getRepository(): Builder
    {
        return $this->repository->newQuery();
    }
}