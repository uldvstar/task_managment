<?php

namespace App\Classes\Modules\ModularTypes\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ModularType;

class ListsModularTypes extends AbstractListRecord
{

    /** @var ModularType */
    private $repository;

    /**
     * ListsModularTypes constructor.
     * @param ModularType $repository
     */
    public function __construct(ModularType $repository)
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