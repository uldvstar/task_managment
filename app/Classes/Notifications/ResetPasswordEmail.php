<?php

namespace App\Classes\Notifications;


use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordEmail extends AbstractEmail
{

    /** @var User */
    private $user;

    /** @var PasswordReset */
    private $attempt;

    /**
     * SendResetPasswordEmail constructor.
     * @param User $user
     * @param PasswordReset $attempt
     */
    public function __construct(User $user, PasswordReset $attempt)
    {
        $this->user = $user;
        $this->attempt = $attempt;
    }

    public function toMail()
    {
        return (new MailMessage)
            ->subject('Reset Password')
            ->view('emails.account.reset_password', ['user' => $this->user, 'attempt' => $this->attempt]);
    }


}