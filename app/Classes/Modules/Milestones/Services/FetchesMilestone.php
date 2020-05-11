<?php

namespace App\Classes\Modules\Milestones\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Milestone;

class FetchesMilestone extends AbstractFetchRecord
{

    /** @var Milestone */
    private $repository;

    /**
     * FetchesMilestone constructor.
     * @param Milestone $repository
     */
    public function __construct(Milestone $repository)
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