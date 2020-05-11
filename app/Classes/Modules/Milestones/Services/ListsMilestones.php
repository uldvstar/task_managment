<?php

namespace App\Classes\Modules\Milestones\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Milestone;

class ListsMilestones extends AbstractListRecord
{

    /** @var Milestone */
    private $repository;

    /**
     * ListsMilestones constructor.
     * @param Milestone $repository
     */
    public function __construct(Milestone $repository)
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