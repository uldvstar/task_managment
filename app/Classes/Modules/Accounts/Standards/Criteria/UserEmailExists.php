<?php

namespace App\Classes\Modules\Accounts\Standards\Criteria;


use App\Classes\Exceptions\ResourceNotFoundException;
use App\Models\User;

class UserEmailExists
{

    /** @var User */
    private $repository;

    /**
     * UserEmailExists constructor.
     * @param User $repository
     */
    public function __construct(User $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $email
     * @return bool
     * @throws ResourceNotFoundException
     */
    public function execute(string $email){

        if(!$this->repository->where('email', $email)->first()){
            throw new ResourceNotFoundException('Unable to find any record that matches the email address provided');
        }

        return true;

    }

}