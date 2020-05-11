<?php

namespace App\Classes\Modules\Comments\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Comment;

class FetchesComment extends AbstractFetchRecord
{

    /** @var Comment */
    private $repository;

    /**
     * FetchesComment constructor.
     * @param Comment $repository
     */
    public function __construct(Comment $repository)
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