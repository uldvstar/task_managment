<?php

namespace App\Classes\Modules\Projects\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;

class FetchesProject extends AbstractFetchRecord
{

    /** @var Project */
    private $repository;

    /**
     * FetchesProject constructor.
     * @param Project $repository
     */
    public function __construct(Project $repository)
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