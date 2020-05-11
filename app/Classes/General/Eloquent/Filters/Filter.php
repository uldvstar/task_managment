<?php

namespace App\Classes\General\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{


    /**
     * @param Builder $builder
     * @param $value
     * @return mixed
     */
    public static function apply(Builder $builder, $value);


}