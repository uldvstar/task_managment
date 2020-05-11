<?php

namespace App\Classes\Modules\Accounts\DataTransferObjects;


use App\Classes\Interfaces\DataTransferObject;

class GeneratePasswordResetObject implements DataTransferObject
{

    /** @var string */
    private $email;

    /**
     * GeneratePasswordResetObject constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }




}