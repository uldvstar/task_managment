<?php

namespace App\Classes\Modules\TimeTrackers\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TimeTracker;

class ListsTimeTrackers extends AbstractListRecord
{

    /** @var TimeTracker */
    private $repository;

    /**
     * ListsTimeTrackers constructor.
     * @param TimeTracker $repository
     */
    public function __construct(TimeTracker $repository)
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