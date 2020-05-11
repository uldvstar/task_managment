<?php

namespace App\Classes\General\Eloquent\Filters;

use App\Classes\ValueObjects\Constants\ModularTypes;
use Illuminate\Database\Eloquent\Builder;

class ModuleType implements Filter
{

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder|mixed
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('module_type', ModularTypes::MODULAR_MODULES[$value]);
    }

}