<?php

namespace App\Classes\General\Abstracts;

use App\Classes\Exceptions\MalformedRequestException;
use App\Classes\Interfaces\DataTransferObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

abstract class AbstractService
{

    /**
     * @param Model $model
     * @param DataTransferObject $object
     * @return mixed
     * @throws MalformedRequestException
     */
    public function execute(Model $model, DataTransferObject $object){

        try{

            /** @var Model $model */
            $model = $this->handler($model);

            if($model->save()){
                return $model;
            }



        } catch (QueryException $exception){
            throw new MalformedRequestException('Unable to update the record due to unexpected error');
        }

    }

    abstract function getModel(Model $model);
    abstract function handler(Model $model);


}