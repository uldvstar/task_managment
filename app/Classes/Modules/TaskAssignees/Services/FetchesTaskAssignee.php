<?php

namespace App\Classes\Modules\TaskAssignees\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TaskAssignee;

class FetchesTaskAssignee extends AbstractFetchRecord
{

    /** @var TaskAssignee */
    private $repository;

    /**
     * FetchesTaskAssignee constructor.
     * @param TaskAssignee $repository
     */
    public function __construct(TaskAssignee $repository)
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