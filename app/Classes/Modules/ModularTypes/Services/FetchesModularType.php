<?php

namespace App\Classes\Modules\ModularTypes\Services;


use App\Classes\General\Eloquent\AbstractFetchRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ModularType;

class FetchesModularType extends AbstractFetchRecord
{

    /** @var ModularType */
    private $repository;

    /**
     * FetchesModularType constructor.
     * @param ModularType $repository
     */
    public function __construct(ModularType $repository)
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