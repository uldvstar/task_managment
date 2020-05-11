<?php

namespace App\Classes\Modules\Accounts\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class PasswordResetObject implements DataTransferObject
{
    
    /** @var String */
    private $token;
    
    /** @var NewPasswordObject */
    private $newPassword;

    /**
     * PasswordResetObject constructor.
     * @param String $token
     * @param NewPasswordObject $newPassword
     */
    public function __construct(String $token, NewPasswordObject $newPassword)
    {
        $this->token = $token;
        $this->newPassword = $newPassword;
    }

    /**
     * @return String
     */
    public function getToken(): String
    {
        return $this->token;
    }

    /**
     * @return NewPasswordObject
     */
    public function getNewPassword(): NewPasswordObject
    {
        return $this->newPassword;
    }


}