<?php

namespace App\Classes\Modules\TaskAssignees\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TaskAssignee;

class ListsTaskAssignees extends AbstractListRecord
{

    /** @var TaskAssignee */
    private $repository;

    /**
     * ListsTaskAssignees constructor.
     * @param TaskAssignee $repository
     */
    public function __construct(TaskAssignee $repository)
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