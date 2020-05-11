<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ListsUsers extends AbstractListRecord
{

    /** @var User */
    private $repository;

    /**
     * ListsUsers constructor.
     * @param User $repository
     */
    public function __construct(User $repository)
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