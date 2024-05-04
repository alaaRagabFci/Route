<?php

namespace App\Actions\User\Auth;

use App\Http\Resources\SuccessResource;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutAction
{
    use AsAction;

    /**
     * @return SuccessResource
     */
    public function asController()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return new SuccessResource(200, __('auth.logout'));
    }
}
