<?php

namespace App\Actions\Generic\Auth;

use App\Enums\UserTypesEnum;
use App\Factories\Notifications\SMSNotificationFactory;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\AccountVerificationCode;
use App\Models\User;
use App\Util\SMSUtil;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class ResendVerificationCode
{
    use AsAction;

    /**
     * handle
     *
     * @param string $phone
     * @param string $countryCode
     * @return ErrorResource|SuccessResource
     * @throws Exception
     */
    public function handle(string $phone, string $countryCode): mixed
    {
        $user = User::where('phone', $phone)->first();

        if ($user && !in_array($user->type, [UserTypesEnum::DRIVER->value, UserTypesEnum::USER->value])) {
            throw new Exception('Not permitted');
        }

        if ($user->phone_verified_at) {
            return new ErrorResource(
                Response::HTTP_BAD_REQUEST,
                __('auth.account_Already_verified')
            );
        }

        $accountVerificationCode = $user->verificationCode;
        if ($accountVerificationCode) {
            $accountVerificationCode->delete();
        }

        $otp = config('app.env') != 'production' ? 5555 : rand(1000, 9999);
        $accountVerificationCode = AccountVerificationCode::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'phone' => $user->phone,
        ]);

        if (config('app.send_sms')) {
            // Send sms
            $notificationClass = SMSNotificationFactory::getNotificationClassByType(SMSUtil::VICTORY_LINK);
            $notificationClass->send(__('auth.otp_sms', ['otp' => $accountVerificationCode->otp]), $countryCode . $phone);
        }

        return new SuccessResource(Response::HTTP_OK, __('auth.sms_sent'), [
            'otp' => $accountVerificationCode->otp
        ]);
    }
}
