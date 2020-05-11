<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class FetchesUser extends AbstractFetchRecord
{

    /** @var User */
    private $repository;

    /**
     * FetchesUser constructor.
     * @param User $repository
     */
    public function __construct(User $repository)
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