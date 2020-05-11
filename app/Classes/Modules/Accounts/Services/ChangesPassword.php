<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\Exceptions\InternalServerErrorException;
use App\Classes\Modules\Accounts\DataTransferObjects\NewPasswordObject;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class ChangesPassword
{

    /**
     * @param User $user
     * @param NewPasswordObject $object
     * @return bool
     * @throws InternalServerErrorException
     */
    public function execute(User $user, NewPasswordObject $object): bool {
        try {

            $user->password = Hash::make($object->getPassword());
            return $user->save();

        } catch (QueryException $exception){
            throw new InternalServerErrorException($exception->getMessage());
        }
    }

}