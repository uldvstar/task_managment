<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\Exceptions\InternalServerErrorException;
use App\Classes\Exceptions\MalformedRequestException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class GeneratesPasswordReset
{

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     * @throws MalformedRequestException
     */
    public function execute(User $user): Model {
        try {

            $passwordReset = $user->passwordReset()->create([
                'token'          => Str::random(60),
                'is_expired'    => false,
                'is_complete'   => false
            ]);

            return $passwordReset;

        } catch (QueryException $exception){
            throw new MalformedRequestException($exception->getMessage());
        }
    }

}