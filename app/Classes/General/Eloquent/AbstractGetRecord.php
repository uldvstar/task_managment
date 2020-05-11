<?php

namespace App\Classes\General\Eloquent;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

abstract class AbstractGetRecord
{

    /** @var array  */
    private const DECORATION_FILTERS = ['per_page', 'order_by'];

    /** @var Collection */
    private $filters;


    /**
     * @return Collection
     */
    private function getQueryFilters(){
        return $this->filters->except(self::DECORATION_FILTERS);
    }

    /**
     * @return Collection
     */
    public function getDecorationFilters(){
        return $this->filters->only(self::DECORATION_FILTERS);
    }

    /**
     * @param null|string $json
     * @return array
     */
    public function deserializeFilters(?string $json): array {
        return $json !== null ? collect(json_decode($json))->toArray() : [];
    }

    /**
     * @return Builder
     */
    private function applyFiltersToQuery(): Builder
    {
        return (new ApplyFiltersToQuery())->execute($this->getRepository(), $this->getQueryFilters()->toArray());
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function handler(array $filters){
        $this->filters = collect($filters);
        return $this->getResults($this->applyFiltersToQuery());
    }


    /**
     * @return Builder
     */
    abstract function getRepository(): Builder;

    /**
     * @param Builder $query
     * @return mixed
     */
    abstract function getResults(Builder $query);

}