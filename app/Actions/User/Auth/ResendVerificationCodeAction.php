<?php

namespace App\Actions\User\Auth;

use App\Actions\Generic\Auth\ResendVerificationCode;
use App\Http\Requests\User\Auth\RsendVerificationCodeRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class ResendVerificationCodeAction
{
    use AsAction;

    /**
     * Resend verification code
     *
     * @param RsendVerificationCodeRequest $request
     * @return ErrorResource|SuccessResource
     */
    public function asController(RsendVerificationCodeRequest $request): mixed
    {
        try {
            return ResendVerificationCode::run($request->phone, $request->country_code);
        } catch (Exception $ex) {
            return new ErrorResource(Response::HTTP_BAD_REQUEST, $ex->getMessage());
        }
    }
}
