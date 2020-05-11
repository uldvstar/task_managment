<?php

namespace App\Classes\Modules\Clients\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Client;

class ListsClients extends AbstractListRecord
{

    /** @var Client */
    private $repository;

    /**
     * ListsClients constructor.
     * @param Client $repository
     */
    public function __construct(Client $repository)
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