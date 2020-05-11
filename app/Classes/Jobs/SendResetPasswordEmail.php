<?php

namespace App\Classes\Jobs;

use App\Classes\Notifications\ResetPasswordEmail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


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


    public function handle()
    {
        $this->user->notify(new ResetPasswordEmail($this->user, $this->attempt));

    }
}
