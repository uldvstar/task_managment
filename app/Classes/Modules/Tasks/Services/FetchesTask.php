<?php

namespace App\Classes\Modules\Tasks\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Task;

class FetchesTask extends AbstractFetchRecord
{

    /** @var Task */
    private $repository;

    /**
     * FetchesTask constructor.
     * @param Task $repository
     */
    public function __construct(Task $repository)
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