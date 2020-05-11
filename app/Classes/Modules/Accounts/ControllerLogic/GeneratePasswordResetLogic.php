<?php

namespace App\Classes\Modules\Accounts\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Jobs\PasswordResetTokenExpiration;
use App\Classes\Jobs\SendResetPasswordEmail;
use App\Classes\Modules\Accounts\DataTransferObjects\GeneratePasswordResetObject;
use App\Classes\Modules\Accounts\Services\FetchesUser;
use App\Classes\Modules\Accounts\Services\GeneratesPasswordReset;
use App\Classes\Modules\Accounts\Standards\Rules\CanGeneratePasswordReset;
use App\Classes\ValueObjects\Constants\Notifications;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneratePasswordResetLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return Notifications::RESET_PASSWORD;
    }

    /** @var CanGeneratePasswordReset */
    private $canGeneratePasswordReset;

    /** @var FetchesUser */
    private $fetchesUser;

    /** @var GeneratesPasswordReset */
    private $generatesPasswordReset;

    /** @var PasswordResetTokenExpiration */
    private $passwordResetTokenExpiration;

    /** @var SendResetPasswordEmail */
    private $sendResetPasswordEmail;

    /**
     * GeneratePasswordResetLogic constructor.
     * @param CanGeneratePasswordReset $canGeneratePasswordReset
     * @param FetchesUser $fetchesUser
     * @param GeneratesPasswordReset $generatesPasswordReset
     * @param PasswordResetTokenExpiration $passwordResetTokenExpiration
     * @param SendResetPasswordEmail $sendResetPasswordEmail
     */
    public function __construct(CanGeneratePasswordReset $canGeneratePasswordReset, FetchesUser $fetchesUser, GeneratesPasswordReset $generatesPasswordReset, PasswordResetTokenExpiration $passwordResetTokenExpiration, SendResetPasswordEmail $sendResetPasswordEmail)
    {
        $this->canGeneratePasswordReset = $canGeneratePasswordReset;
        $this->fetchesUser = $fetchesUser;
        $this->generatesPasswordReset = $generatesPasswordReset;
        $this->passwordResetTokenExpiration = $passwordResetTokenExpiration;
        $this->sendResetPasswordEmail = $sendResetPasswordEmail;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Classes\Exceptions\AccessForbiddenException
     * @throws \App\Classes\Exceptions\MalformedRequestException
     * @throws \App\Classes\Exceptions\RequestValidationException
     * @throws \App\Classes\Exceptions\ResourceNotFoundException
     */
    public function logic(Request $request): JsonResponse {

        $object = new GeneratePasswordResetObject($request->input('email'));

        if($this->canGeneratePasswordReset->passes($object)) {
            $user = $this->fetchesUser->execute(['email' => $object->getEmail()]);

            $attempt = $this->generatesPasswordReset->execute($user);

            $this->passwordResetTokenExpiration::dispatch($attempt)->delay(now()->addHours(24));
            $this->sendResetPasswordEmail::dispatch($user, $attempt);

            return $this->response(['email' => $object->getEmail()]);
        }
    }

}