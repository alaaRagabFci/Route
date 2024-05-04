<?php

namespace App\Actions\User\Auth;

use App\Actions\Generic\Auth\ForgetPassword;
use App\Http\Requests\User\Auth\ForgetPasswordRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordAction
{
    use AsAction;

    /**
     * Resend verification code
     *
     * @param ForgetPasswordRequest $request
     * @return SuccessResource|ErrorResource
     */
    public function asController(ForgetPasswordRequest $request): mixed
    {
        try {
            return ForgetPassword::run($request->phone, $request->country_code);
        } catch (Exception $ex) {
            return new ErrorResource(Response::HTTP_BAD_REQUEST, $ex->getMessage());
        }
    }
}
