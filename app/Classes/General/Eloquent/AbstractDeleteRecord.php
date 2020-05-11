<?php

namespace App\Classes\General\Eloquent;

use App\Classes\Exceptions\MalformedRequestException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

abstract class AbstractDeleteRecord
{

    /**
     * @param Model $model
     * @return mixed
     * @throws MalformedRequestException
     */
    public function handler(Model $model){
        try{

            if($model->delete()){
                return [];
            }

        } catch (QueryException|\Exception $exception){
            dd($exception->getMessage());
            throw new MalformedRequestException('Unable to update the record due to unexpected error');
        }
    }



}