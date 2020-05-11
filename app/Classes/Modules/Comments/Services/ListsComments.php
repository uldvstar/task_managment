<?php

namespace App\Classes\Modules\Comments\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Comment;

class ListsComments extends AbstractListRecord
{

    /** @var Comment */
    private $repository;

    /**
     * ListsComments constructor.
     * @param Comment $repository
     */
    public function __construct(Comment $repository)
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