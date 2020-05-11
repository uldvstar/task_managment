<?php

namespace App\Classes\Modules\MilestoneTaskAssignees\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MilestoneTaskAssignee;

class ListsMilestoneTaskAssignees extends AbstractListRecord
{

    /** @var MilestoneTaskAssignee */
    private $repository;

    /**
     * ListsMilestoneTaskAssignees constructor.
     * @param MilestoneTaskAssignee $repository
     */
    public function __construct(MilestoneTaskAssignee $repository)
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