<?php

namespace App\Actions\User\Auth;

use App\Actions\Generic\Auth\ResetPassword;
use App\Http\Requests\User\Auth\ResetPasswordRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ResetPasswordAction
{
    use AsAction;

    /**
     * Resend verification code
     *
     * @param ResetPasswordRequest $request
     * @return ErrorResource|SuccessResource
     */
    public function asController(ResetPasswordRequest $request): mixed
    {
        try {
            return ResetPassword::run($request->all());
        } catch (Exception $ex) {
            return new ErrorResource(Response::HTTP_BAD_REQUEST, $ex->getMessage());
        }
    }
}
