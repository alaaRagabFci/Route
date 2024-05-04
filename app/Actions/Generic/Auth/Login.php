<?php

namespace App\Actions\Generic\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class Login
{
    use AsAction;

    /**
     * handle
     *
     * @param $request
     * @return User|bool
     */
    public function handle($request): mixed
    {
        $phone = $request->phone;
        $password = $request->password;
        $user = User::where('phone', $phone)->first();

        if ($user && Auth::attempt(['phone' => $phone, 'password' => $password])) {
            return $user;
        }

        return false;
    }
}
