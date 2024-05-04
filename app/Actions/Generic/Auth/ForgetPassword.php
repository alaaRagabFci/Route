<?php

namespace App\Actions\Generic\Auth;

use App\Enums\UserTypesEnum;
use App\Factories\Notifications\SMSNotificationFactory;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use App\Util\SMSUtil;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class ForgetPassword
{
    use AsAction;

    /**
     * @param string $phone
     * @param string $countryCode
     * @return mixed
     * @throws Exception
     */
    public function handle(string $phone, string $countryCode): mixed
    {
        $user = User::where('phone', $phone)->first();

        if ($user && !in_array($user->type, [UserTypesEnum::DRIVER->value, UserTypesEnum::USER->value])) {
            throw new Exception('Not permitted');
        }

        //Create Password Reset code
        DB::table('reset_code_passwords')->updateOrInsert(
            [
                'phone' => $user->phone,
            ],
            [
                'otp' => config('app.env') != 'production' ? 5555 : rand(1000, 9999),
                'created_at' => Carbon::now(),
            ]
        );

        $resetCode = DB::table('reset_code_passwords')->where('phone', $user->phone)->first();

        if (config('app.send_sms')) {
            // Send sms
            $notificationClass = SMSNotificationFactory::getNotificationClassByType(SMSUtil::VICTORY_LINK);
            $notificationClass->send(__('auth.otp_sms', ['otp' => $resetCode->otp]), $countryCode . $phone);
        }

        return new SuccessResource(Response::HTTP_OK, __('auth.sms_sent'), [
            'otp' => $resetCode->otp,
        ]);
    }
}
