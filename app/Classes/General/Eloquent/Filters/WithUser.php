<?php

namespace App\Classes\General\Eloquent\Filters;


use Illuminate\Database\Eloquent\Builder;

class WithUser implements Filter
{

    /**
     * @param Builder $builder
     * @param $value
     * @return mixed
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->with('user');
    }
}