<?php

namespace App\Actions\Generic\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class ChangeUserPassword
{
    use AsAction;

    /**
     * handle
     *
     * @param string $oldPassword
     * @param User $user
     * @param string $newPassword
     * @return User
     * @throws Exception
     */
    public function handle(string $oldPassword, User $user, string $newPassword): User
    {
        if (!Hash::check($oldPassword, $user->password)) {
            throw new Exception(__('auth.incorrect_old_password'));
        }

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        return $user;
    }
}
