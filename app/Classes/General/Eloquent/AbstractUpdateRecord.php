<?php

namespace App\Classes\General\Eloquent;

use App\Classes\Exceptions\MalformedRequestException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

abstract class AbstractUpdateRecord
{


    /**
     * @param Model|null $model
     * @return Model|null
     * @throws MalformedRequestException
     */
    public function handler(?Model $model){
        try{
            if($model->save()){
                return $model;
            }

        } catch (QueryException $exception){
            throw new MalformedRequestException('Unable to update the record due to unexpected error');
        }
    }



}