<?php

namespace App\Classes\Modules\ProjectMilestones\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ProjectMilestone;

class FetchesProjectMilestone extends AbstractFetchRecord
{

    /** @var ProjectMilestone */
    private $repository;

    /**
     * FetchesProjectMilestone constructor.
     * @param ProjectMilestone $repository
     */
    public function __construct(ProjectMilestone $repository)
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