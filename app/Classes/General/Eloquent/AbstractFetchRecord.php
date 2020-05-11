<?php

namespace App\Classes\General\Eloquent;


use App\Classes\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractFetchRecord extends AbstractGetRecord
{

    /**
     * @param array|null $filters
     * @return mixed
     */
    public function execute(array $filters = []){

        return $this->handler($filters);

    }


    /**
     * @param Builder $query
     * @return Model
     * @throws ResourceNotFoundException
     */
    public function getResults(Builder $query): Model {
        if(!$query->exists()){
            throw new ResourceNotFoundException('Unable to find any record based on the criteria provided');
        }

        return $query->first();
    }

}