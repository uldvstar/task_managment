<?php

namespace App\Classes\Modules\MilestoneTasks\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MilestoneTask;

class ListsMilestoneTasks extends AbstractListRecord
{

    /** @var MilestoneTask */
    private $repository;

    /**
     * ListsMilestoneTasks constructor.
     * @param MilestoneTask $repository
     */
    public function __construct(MilestoneTask $repository)
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