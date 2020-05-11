<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\Exceptions\MalformedRequestException;
use App\Models\PasswordReset;
use Illuminate\Database\QueryException;

class ExpiresPasswordReset
{


    /**
     * @param PasswordReset $attempt
     * @throws MalformedRequestException
     */
    public function execute(PasswordReset $attempt){

        try {

            $attempt->is_expired = true;
            $attempt->save();

        } catch (QueryException $exception){
            throw new MalformedRequestException($exception->getMessage());
        }


    }


}