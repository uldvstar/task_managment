<?php

namespace App\Classes\General\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserName implements Filter
{

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder|mixed
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where(function($query) use ($value) {
            $query->where('first_name', 'LIKE', '%' . $value . '%')->orWhere('last_name', 'LIKE', '%' . $value . '%');
        });
    }

}