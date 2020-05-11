<?php

namespace App\Classes\Modules\MilestoneTasks\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MilestoneTask;

class FetchesMilestoneTask extends AbstractFetchRecord
{

    /** @var MilestoneTask */
    private $repository;

    /**
     * FetchesMilestoneTask constructor.
     * @param MilestoneTask $repository
     */
    public function __construct(MilestoneTask $repository)
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