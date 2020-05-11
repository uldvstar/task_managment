<?php

namespace App\Classes\General\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

class Email implements Filter
{

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder|mixed
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('email', $value);
    }

}