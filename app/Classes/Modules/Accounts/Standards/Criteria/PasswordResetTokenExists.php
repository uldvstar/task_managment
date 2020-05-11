<?php

namespace App\Classes\Modules\Accounts\Standards\Criteria;


use App\Classes\Exceptions\ResourceNotFoundException;
use App\Models\PasswordReset;

class PasswordResetTokenExists
{

    /** @var PasswordReset */
    private $repository;

    /**
     * TokenExistsValidation constructor.
     * @param PasswordReset $repository
     */
    public function __construct(PasswordReset $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $token
     * @return bool
     * @throws ResourceNotFoundException
     */
    public function execute(string $token){

        if(!$this->repository->active()->where('token', $token)->first()){
            throw new ResourceNotFoundException('The reset password token has expired or doesn\'t exist');
        }
        return true;

    }

}