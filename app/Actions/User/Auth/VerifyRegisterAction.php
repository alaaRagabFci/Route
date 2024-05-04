<?php

namespace App\Actions\User\Auth;

use App\Actions\Generic\Auth\VerifyRegisteration;
use App\Http\Requests\User\Auth\VerifyRegisterRequest;
use App\Http\Resources\Driver\Users\UserResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\UserDevice;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyRegisterAction
{
    use AsAction;

    /**
     * asController
     *
     * @param  VerifyRegisterRequest $request
     * @return UserResource|JsonResponse
     */
    public function asController(VerifyRegisterRequest $request): mixed
    {
        $phone = $request->phone;
        $otp = $request->otp;
        $accountVerificationCode = VerifyRegisteration::run($phone, $otp);

        if (!$accountVerificationCode) {
            return new ErrorResource(400, __('auth.otp_check_error'));
        }

        $accountVerificationCode->user->update([
            'phone_verified_at' => now(),
        ]);

        $accountVerificationCode->delete();

        UserDevice::updateOrCreate(
            [
                'device_token' => $request->device_token,
            ],
            [
                'user_id' => $accountVerificationCode->user->id
            ]
        );

        return new SuccessResource(200, "", [
            'access_token' => $accountVerificationCode->user->createToken('authToken')->plainTextToken,
            'user' => new UserResource($accountVerificationCode->user),
        ]);
    }
}
