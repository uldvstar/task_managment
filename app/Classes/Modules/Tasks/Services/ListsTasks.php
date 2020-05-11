<?php

namespace App\Classes\Modules\Tasks\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Task;

class ListsTasks extends AbstractListRecord
{

    /** @var Task */
    private $repository;

    /**
     * ListsTasks constructor.
     * @param Task $repository
     */
    public function __construct(Task $repository)
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