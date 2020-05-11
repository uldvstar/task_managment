<?php

namespace App\Classes\General\Eloquent;


use App\Classes\Exceptions\MalformedRequestException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

abstract class AbstractListRecord extends AbstractGetRecord
{


    /**
     * @param array $filters
     * @return mixed
     * @throws MalformedRequestException
     */
    public function execute(array $filters = []){

        try{

            return $this->handler($filters);

        } catch (QueryException $exception){
            throw new MalformedRequestException('Unable to fetch the list of records due to unexpected error');
        }

    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function getResults(Builder $query) {
        $filters = $this->getDecorationFilters();
        if($filters->has('order_by')){
            $query = $query->orderBy($filters->get('order_by')->column, $filters->get('order_by')->DESC ? 'DESC': 'ASC');
        }

        if($filters->has('per_page')){
           return $query->paginate($filters->get('per_page'));
        }

        return $query->get();

    }

}