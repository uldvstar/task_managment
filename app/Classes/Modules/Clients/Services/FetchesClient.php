<?php

namespace App\Classes\Modules\Clients\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Client;

class FetchesClient extends AbstractFetchRecord
{

    /** @var Client */
    private $repository;

    /**
     * FetchesClient constructor.
     * @param Client $repository
     */
    public function __construct(Client $repository)
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