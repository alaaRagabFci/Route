<?php

namespace App\Actions\Generic\Auth;

use App\Models\AccountVerificationCode;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyRegisteration
{
    use AsAction;

    /**
     * handle
     *
     * @param string $phone
     * @param string $otp
     * @return bool|AccountVerificationCode
     */
    public function handle(string $phone, string $otp): mixed
    {
        $accountVerificationCode = AccountVerificationCode::where([
            ['phone', $phone],
            ['otp', $otp],
        ])->with('user')->first();

        if (!$accountVerificationCode || $accountVerificationCode->created_at->addMinutes(5) < now()) {
            return false;
        }

        return $accountVerificationCode;
    }
}
