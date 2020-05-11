<?php

namespace App\Classes\Modules\Accounts\ControllerLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Accounts\DataTransferObjects\NewPasswordObject;
use App\Classes\Modules\Accounts\DataTransferObjects\PasswordResetObject;
use App\Classes\Modules\Accounts\Services\ChangesPassword;
use App\Classes\Modules\Accounts\Services\CompletesPasswordReset;
use App\Classes\Modules\Accounts\Services\FetchesPasswordReset;
use App\Classes\Modules\Accounts\Standards\Rules\CanResetPassword;
use App\Classes\ValueObjects\Constants\Notifications;
use App\Models\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return Notifications::CHANGE_PASSWORD;
    }

    /** @var CanResetPassword */
    private $canResetPassword;

    /** @var FetchesPasswordReset */
    private $fetchesPasswordReset;

    /** @var ChangesPassword */
    private $changePassword;

    /** @var CompletesPasswordReset */
    private $completesPasswordResetToken;

    /**
     * ResetPasswordLogic constructor.
     * @param CanResetPassword $canResetPassword
     * @param FetchesPasswordReset $fetchesPasswordReset
     * @param ChangesPassword $changePassword
     * @param CompletesPasswordReset $completesPasswordResetToken
     */
    public function __construct(CanResetPassword $canResetPassword, FetchesPasswordReset $fetchesPasswordReset, ChangesPassword $changePassword, CompletesPasswordReset $completesPasswordResetToken)
    {
        $this->canResetPassword = $canResetPassword;
        $this->fetchesPasswordReset = $fetchesPasswordReset;
        $this->changePassword = $changePassword;
        $this->completesPasswordResetToken = $completesPasswordResetToken;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Classes\Exceptions\AccessForbiddenException
     * @throws \App\Classes\Exceptions\InternalServerErrorException
     * @throws \App\Classes\Exceptions\MalformedRequestException
     * @throws \App\Classes\Exceptions\RequestValidationException
     * @throws \App\Classes\Exceptions\ResourceNotFoundException
     */
    public function logic(Request $request): JsonResponse {

        $object = new PasswordResetObject($request->input('token'),
            new NewPasswordObject($request->input('password'), $request->input('confirmPassword')));

        if($this->canResetPassword->passes($object)) {
            /** @var PasswordReset $passwordReset */
            $passwordReset = $this->fetchesPasswordReset->execute(['token' => $object->getToken(), 'with_user']);
            $this->changePassword->execute($passwordReset->user, $object->getNewPassword());
            $this->completesPasswordResetToken->execute($passwordReset);

            return $this->response();
        }
    }

}