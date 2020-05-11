<?php

namespace App\Classes\Modules\ProjectMilestones\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ProjectMilestone;

class ListsProjectMilestones extends AbstractListRecord
{

    /** @var ProjectMilestone */
    private $repository;

    /**
     * ListsProjectMilestones constructor.
     * @param ProjectMilestone $repository
     */
    public function __construct(ProjectMilestone $repository)
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