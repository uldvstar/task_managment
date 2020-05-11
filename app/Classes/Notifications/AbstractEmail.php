<?php

namespace App\Classes\Notifications;

use Illuminate\Notifications\Notification;

class AbstractEmail extends Notification
{

    public function via()
    {
        return 'mail';
    }

}