<?php

namespace App\Classes\Modules\Projects\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;

class ListsProjects extends AbstractListRecord
{

    /** @var Project */
    private $repository;

    /**
     * ListsProjects constructor.
     * @param Project $repository
     */
    public function __construct(Project $repository)
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