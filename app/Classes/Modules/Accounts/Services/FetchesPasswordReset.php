<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use App\Models\PasswordReset;
use Illuminate\Database\Eloquent\Builder;

class FetchesPasswordReset extends AbstractFetchRecord
{

    /** @var PasswordReset */
    private $repository;

    /**
     * FetchesResetPasswordToken constructor.
     * @param PasswordReset $repository
     */
    public function __construct(PasswordReset $repository)
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