<?php

namespace App\Classes\Modules\Accounts\DataTransferObjects;


use App\Classes\Interfaces\DataTransferObject;

class AuthenticationCredentialsObject implements DataTransferObject
{

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var boolean */
    private $rememberUser;

    /**
     * AuthenticationCredentials constructor.
     * @param string $email
     * @param string $password
     * @param bool $rememberUser
     */
    public function __construct(string $email, string $password, ?bool $rememberUser = false)
    {
        $this->email = $email;
        $this->password = $password;
        $this->rememberUser = $rememberUser;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isRememberUser(): bool
    {
        return $this->rememberUser;
    }



}