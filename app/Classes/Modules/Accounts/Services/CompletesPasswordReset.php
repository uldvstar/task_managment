<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\Exceptions\MalformedRequestException;
use App\Models\PasswordReset;
use Illuminate\Database\QueryException;

class CompletesPasswordReset
{


    /**
     * @param PasswordReset $attempt
     * @throws MalformedRequestException
     */
    public function execute(PasswordReset $attempt){

        try {

            $attempt->is_complete = true;
            $attempt->save();

            return;

        } catch (QueryException $exception){

            throw new MalformedRequestException($exception->getMessage());

        }

    }

}