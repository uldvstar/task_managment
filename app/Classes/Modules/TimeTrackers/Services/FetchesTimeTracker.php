<?php

namespace App\Classes\Modules\TimeTrackers\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TimeTracker;

class FetchesTimeTracker extends AbstractFetchRecord
{

    /** @var TimeTracker */
    private $repository;

    /**
     * FetchesTimeTracker constructor.
     * @param TimeTracker $repository
     */
    public function __construct(TimeTracker $repository)
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