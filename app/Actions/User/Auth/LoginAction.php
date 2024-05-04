<?php

namespace App\Actions\User\Auth;

use App\Actions\Generic\Auth\Login;
use App\Enums\UserTypesEnum;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Resources\Driver\Users\UserResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\UserDevice;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginAction
{
    use AsAction;

    /**
     * asController
     *
     * @param LoginRequest $request
     * @return UserResource|JsonResponse
     */
    public function asController(LoginRequest $request): mixed
    {
        $user = Login::run($request);
        if ($user && $user->type === UserTypesEnum::USER->value) {
            if (!$user->phone_verified_at) {
                return response()->json([
                    'message' => __('auth.verify_phone'),
                    'phone_verified' => false,
                ], 400);
            }

            UserDevice::updateOrCreate(
                [
                    'device_token' => $request->device_token,
                ],
                [
                    'user_id' => $user->id
                ]
            );

            return new SuccessResource(200, "", [
                'access_token' => $user->createToken('authToken')->plainTextToken,
                'user' => new UserResource($user),
            ]);
        } else {
            return new ErrorResource(401, __('auth.authentication_failed'));
        }
    }
}
