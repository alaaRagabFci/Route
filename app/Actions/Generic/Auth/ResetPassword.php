<?php

namespace App\Actions\Generic\Auth;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ResetPassword
{
    use AsAction;

    /**
     * handle
     *
     * @param array $data
     * @return ErrorResource|SuccessResource
     * @throws Exception
     */
    public function handle(array $data): mixed
    {
        $passwordOtp = DB::table('reset_code_passwords')->where([
            ['phone', $data['phone']],
            ['otp', $data['otp']],
        ])->first();

        if (!$passwordOtp) {
            throw new Exception(__('auth.otp_check_error'));
        }

        $user = User::where('phone', $passwordOtp->phone)->first();

        if (Carbon::parse($passwordOtp->created_at)->addMinutes(5) < now()) {
            DB::table('reset_code_passwords')->where('phone', $data['phone'])->delete();

            return new ErrorResource(
                Response::HTTP_BAD_REQUEST,
                __('auth.otp_expired')
            );
        }

        // update user password
        $user->update([
            'password' => bcrypt($data['password']),
        ]);

        DB::table('reset_code_passwords')->where('phone', $data['phone'])->delete();

        return new SuccessResource(
            Response::HTTP_OK,
            __('auth.password_reset')
        );
    }
}
