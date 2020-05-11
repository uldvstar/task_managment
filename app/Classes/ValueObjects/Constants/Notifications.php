<?php

namespace App\Classes\ValueObjects\Constants;


class Notifications
{

    public const UNDEFINED = [
        'title' => 'Unknown Action',
        'message' => 'unknown message..'
    ];

    public const AUTHENTICATION = [
        'title' => 'Authentication',
        'message' => 'You have successfully logged in to your account'
    ];

    public const RESET_PASSWORD = [
        'title' => 'Reset Password',
        'message' => 'You have successfully sent you an email to reset your password'
    ];

    public const CHANGE_PASSWORD = [
        'title' => 'Change Password',
        'message' => 'You password has changed successfully'
    ];

}