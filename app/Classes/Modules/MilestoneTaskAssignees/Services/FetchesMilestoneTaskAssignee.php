<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MilestoneTaskAssignee;

class FetchesMilestoneTaskAssignee extends AbstractFetchRecord
{

    /** @var MilestoneTaskAssignee */
    private $repository;

    /**
     * FetchesMilestoneTaskAssignee constructor.
     * @param MilestoneTaskAssignee $repository
     */
    public function __construct(MilestoneTaskAssignee $repository)
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