<?php

namespace App\Classes\Jobs;

use App\Classes\Exceptions\MalformedRequestException;
use App\Classes\Modules\Accounts\Services\ExpiresPasswordReset;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PasswordResetTokenExpiration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var PasswordReset */
    private $attempt;

    /**
     * PasswordResetTokenExpiration constructor.
     * @param PasswordReset $attempt
     */
    public function __construct(PasswordReset $attempt)
    {
        $this->attempt = $attempt;
    }


    public function handle()
    {
        try {

            (new ExpiresPasswordReset())->execute($this->attempt);

        } catch (MalformedRequestException $exception){

        }

    }
}
