<?php

namespace App\Classes\Modules\Accounts\DataTransferObjects;


use App\Classes\Interfaces\DataTransferObject;

class NewPasswordObject implements DataTransferObject
{

    /** @var String */
    private $password;

    /** @var String */
    private $ConfirmPassword;

    /**
     * NewPassword constructor.
     * @param String $password
     * @param String $ConfirmPassword
     */
    public function __construct(String $password, String $ConfirmPassword)
    {
        $this->password = $password;
        $this->ConfirmPassword = $ConfirmPassword;
    }

    /**
     * @return String
     */
    public function getPassword(): String
    {
        return $this->password;
    }

    /**
     * @return String
     */
    public function getConfirmPassword(): String
    {
        return $this->ConfirmPassword;
    }


}