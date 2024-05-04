<?php

namespace App\Actions\User\Auth;

use App\Actions\Generic\Auth\RegisterAccount;
use App\Enums\UserStatusEnum;
use App\Enums\UserTypesEnum;
use App\Factories\Notifications\SMSNotificationFactory;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Resources\SuccessResource;
use App\Models\AccountVerificationCode;
use App\Util\SMSUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\{DB};
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterAction
{
    use AsAction;

    /**
     * asController
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function asController(RegisterRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            $user = RegisterAccount::run($data, UserStatusEnum::PENDING->value, UserTypesEnum::USER->value);

            $otp = config('app.env') != 'production' ? 5555 : rand(1000, 9999);
            AccountVerificationCode::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'phone' => $user->phone,
            ]);

            if (config('app.send_sms')) {
                // Send sms
                $notificationClass = SMSNotificationFactory::getNotificationClassByType(SMSUtil::VICTORY_LINK);
                $notificationClass->send(__('auth.otp_sms', ['otp' => $otp]), $data['country_code'] . $data['phone']);
            }

            return new SuccessResource(201, "", [
                'otp' => $otp
            ]);
        });
    }
}
