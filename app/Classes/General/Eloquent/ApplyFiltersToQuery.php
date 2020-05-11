<?php

namespace App\Classes\General\Eloquent;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApplyFiltersToQuery
{

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function execute(Builder $query, array $filters) : Builder{
        foreach($filters as $filterName => $value){
            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }

        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\Filters\\' . Str::studly($name);
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }


}